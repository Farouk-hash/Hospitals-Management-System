<?php

namespace App\Livewire\Chat;

use App\Models\Chat\Conversation;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Log;

class Chatlist extends Component
{   
    public $conversations , $sender_id ;
    protected function ensureAuthentication(){
        if(Auth::guard('doctor')->check()){
            Auth::shouldUse('doctor');
        }
        elseif(Auth::guard('ray_employee')->check()){
            Auth::shouldUse('ray_employee');
        }
        else{
            return redirect()->route('login');
        }
    }
    public function boot(){
        $this->ensureAuthentication();
    }

    public function mount(){
        $this->loadConversations();
    }
    
    public function loadConversations(){
        $this->conversations = Conversation::ConversationsBetweenParties()->get();
    }

    #[On('lastMessageCurrentUser')]
    public function lastMessageCurrentUser()
    {
        $this->loadConversations();        
    }

    public function chatSelected($conversationID){
        $this->dispatch('chat-selected' , $conversationID)->to(Chatbox::class);
    }

    public function render()
    {   
        if(empty($this->conversations))$this->loadConversations();
        return view('livewire.chat.chatlist');
    }
}
