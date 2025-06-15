<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    
    $chat = App\Models\Chat::findOr($chatId);
    if(!$chat || $chat->sender_id != $user || $chat->receiver_id != $user){
        return false;
    }
    return true;

});

Broadcast::channel('notification' , function($user){
    return (bool) $user;
});

Broadcast::channel('status.{chat_id}' , function($user, $chat_id){
    return ['id' => $user->id , 'chat_id' => $chat_id];
});

?>