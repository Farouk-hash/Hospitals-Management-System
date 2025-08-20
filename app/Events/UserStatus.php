<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id , $user_class ;
    public $target_user_id , $target_user_class ;
    public $user_status ; 
    public function __construct($user_id , $user_class , $target_user_id , $target_user_class , $user_status)
    {
        $this->user_id = $user_id; 
        $this->user_class = $user_class; 
        $this->target_user_id = $target_user_id; 
        $this->target_user_class = $target_user_class; 
        $this->user_status = $user_status; 
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("userStatus.{$this->target_user_class}.{$this->target_user_id}"),
        ];
    }

    public function broadcastAs(){
        return 'status-changed';
    }

    public function broadcastWith(){
        return[
            'user_id' => $this->user_id,
            'user_class' => $this->user_class,
            'timestamp' => now(),
            'status' => $this->user_status ? 'online' : 'offline',
        ];
    }
}
