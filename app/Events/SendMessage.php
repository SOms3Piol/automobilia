<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public $chat_id;
    public $sender_id;
    public function __construct(string $message , int $chat_id , int $sender_id)
    {
        //
        $this->message = $message;
        $this->chat_id = $chat_id;
        $this->sender_id = $sender_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->chat_id),
            new PrivateChannel('notification'),
            new PresenceChannel('status.'. $this->chat_id)
        ];
    }
    public function broadcastAs(){
        return "message.sent";
    }
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'chat_id' => $this->chat_id,
            'sender_id' => $this->sender_id,
        ];
    }
}
