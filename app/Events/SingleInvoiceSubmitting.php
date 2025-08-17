<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SingleInvoiceSubmitting implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username  ,$doctor_id , $message , $patient_id , $time  ; 
  
    public function __construct($data)
    {
        $this->username = $data['name'];      
        $this->doctor_id = $data['user_id'];
        $this->patient_id = $data['patient_id']; // for href route to patient-details 
        $this->message = $data['message'];
        $this->time = $data['time'];
    }

  
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('single-invoice-'.$this->doctor_id),
        ];
    }
    public function broadcastAs(){
        return 'single-invoice-event';
    }
}
