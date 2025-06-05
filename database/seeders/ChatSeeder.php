<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MessageRead;
use App\Models\PurchasedPlan;

class ChatSeeder extends Seeder
{
    public function run()
    {
        // Create two users
        $user1 = User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => bcrypt('password'),
        ]);
        PurchasedPlan::insert([
            'plan_id'=>1,
            'user_id'=>$user1->id,
            'allowed_ads'=>5
        ]);
        $user2 = User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => bcrypt('password'),
        ]);
        PurchasedPlan::insert([
            'plan_id'=>1,
            'user_id'=>$user2->id,
            'allowed_ads'=>5
        ]);

        // Create a chat where Alice is sender, Bob is receiver
        $chat1 = Chat::create([
            'sender_id' => $user1->id,
            'receiver_id' => $user2->id,
            'last_message_id' => 0
            // add other chat fields if needed
        ]);

        // Add messages to chat1
       $message1= Message::create([
            'chat_id' => $chat1->id,
            'sender_id' => $user1->id,
            'message' => 'Hi Bob, this is Alice.',
        ]);
        $message2= Message::create([
            'chat_id' => $chat1->id,
            'sender_id' => $user2->id,
            'message' => 'Hello Alice, nice to hear from you!',
        ]);

       $message3= Message::create([
        'chat_id' => $chat1->id,
        'sender_id' => $user1->id,
        'message' => 'I am fine!'
       ]);
       $message4= Message::create([
        'chat_id' => $chat1->id,
        'sender_id' => $user2->id,
        'message' => 'Thats Great.!'
       ]);



       MessageRead::create([
        'chat_id' => $chat1->id,
        'sender_id' => $user1->id,
        'message_id' => 2
       ]);
       MessageRead::create([
        'chat_id' => $chat1->id,
        'sender_id' => $user2->id,
        'message_id' => 2
       ]);

       Chat::updateOrInsert(
        ['id' => $chat1->id],               
        ['last_message_id' => 4]
       );
          
    }
}
