<?php

namespace App\Livewire\Chat;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sendmessage extends Component
{
    public $message;
    
    public function submit(){

        if(!$this->message)return ;
        $this->message = trim($this->message);
        $messageToSend = $this->message ; 
        $this->reset('message');
        $this->dispatch('sendMessage' , $messageToSend)->to(Chatbox::class);
    }
    public function submitOnEnter()
    {
        $this->submit();
    }
    
    public function render()
    {
        return view('livewire.chat.sendmessage');
    }
}
