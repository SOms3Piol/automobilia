<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MessageRead;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class ChatController extends Controller{

    public function index(){

        $user = auth()->user();
        
        if(!$user){
            return abort(404, 'User Not Found');
        }

        $chats = $user->chats()->with(['sender','receiver'])->get()
              ->map(function ($chat) use ($user) {
                
                    $lastRead = MessageRead::where('chat_id', $chat->id)
                        ->where('sender_id', $user->id)
                        ->first();

                    $lastSeenId = $lastRead->message_id;

                    
                    $unreadCount = Message::where('chat_id', $chat->id)
                        ->where('sender_id', '!=', $user->id)
                        ->where('id', '>', $lastSeenId)
                        ->count();

                   
                    $chat->unread_count = $unreadCount;

                    return $chat;
                });
        return view('chat.index' , compact('chats', ) );
    }


    public function chat_messages(String $id){

        $chat = Chat::find($id);
        $userId = auth()->user()->id;
        if (!$chat || ($chat->sender_id !== $userId && $chat->receiver_id !== $userId)) {
            return response()->json(['error' => 'Unauthorized or chat not found'], 403);
        }

        $messages = Message::where('chat_id',$id)->orderBy('id' , 'desc')->paginate(50);

        $last_seen_id = MessageRead::select(['message_id'])
                        ->where('chat_id' , $id)
                        ->where('sender_id' , $userId)
                        ->first();
        MessageRead::updateOrInsert(
            ['chat_id' => $id, 'sender_id' => $userId], 
            ['message_id' => $chat->last_message_id]
        );

        return response()->json([
            'messages'=>$messages,
            'last_seen_id' => $last_seen_id,
            'next_page_url' => $messages->nextPageUrl(),
            'ok' => true
        ]);
    }


    public function send_message( Request $request, string $id){
        $chat = Chat::find($id);
        $userId = auth()->user()->id;
        if (!$chat || ($chat->sender_id !== $userId && $chat->receiver_id !== $userId)) {
            return response()->json(['error' => 'Unauthorized or chat not found'], 403);
        }




       $message= Message::create([
            'chat_id' => $id,
            'sender_id' => $userId,
            'message'=> $request->input('message')
        ]);

        $chat->update(
            [
                'last_message_id' => $message->id
            ]
        );


        broadcast(new SendMessage($message->message, $id , $userId))->toOthers();

        return response()->json([
            'success' => true,
            'message' => 'message created successfully'
        ]);

    }


   public static function isAuthorized($id){
        $chat = Chat::find($id);
        $userId = auth()->user()->id;
        if (!$chat || ($chat->sender_id !== $userId && $chat->receiver_id !== $userId)) {
            return false;
        }
        return true;
    }
}

?>