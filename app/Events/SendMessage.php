<?php

namespace App\Events;

use App\Models\Chat\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Log;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $message , $conversationID;

    public function __construct(Message $message , $conversationID)
    {
        $this->message = $message;
        $this->conversationID = $conversationID;
    }

    // Determine the private channel based on receiver type/id
    public function broadcastOn(): PrivateChannel
    {
        $receiverType = class_basename($this->message->receiver_type);
        $receiverId = $this->message->receiver_id;
        Log::info("broadCastOn to chat.{$receiverType}.{$receiverId}");
        return new PrivateChannel("chat.{$receiverType}.{$receiverId}");
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }

    public function broadcastWith()
    {
        return [
            'message' => [
                'id' => $this->message->id,
                'body' => $this->message->body,
                'sender_id' => $this->message->sender_id,
                'sender_type' => $this->message->sender_type,
                'conversation_id' => $this->message->converstaion_id,
                'created_at' => $this->message->created_at->toISOString(),
                'created_at_human' => $this->message->created_at->diffForHumans(),
                'conversationIDGiven'=>$this->conversationID,
            ],
        ];
    }
}
