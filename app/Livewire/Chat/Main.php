<?php

namespace App\Livewire\Chat;

use App\Events\UserStatus;
use App\Models\Chat\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Log;

class Main extends Component
{
    // view-components ;
    public $layout , $selectedChat=false  , $selectedConversationId; 
    
    protected function ensureAuthentication(){
        if(Auth::guard('doctor')->check()){
            Auth::shouldUse('doctor');
            $this->layout = 'doctors_dashboard.layouts.master-doctor';

        }
        elseif(Auth::guard('ray_employee')->check()){
            Auth::shouldUse('ray_employee');
            $this->layout = 'dasboard_rays_employees.layouts.master-xray-employee';

        }
        else{
            return redirect()->route('login');
        }
    }
    public function boot(){
        $this->ensureAuthentication();
    }
    public function mount(){
        $this->ensureAuthentication();
    }  

    #[On('conversationCreated')] // FROM CREATECHAT COMPONENT ;
    public function conversationCreated($conversationID){ 
        $this->selectedChat = true;
        // $this->dispatch('highlight-selected-chat', $conversationID);
        $this->selectedConversationId = $conversationID; // Add this property

    }

    #[On('go-back')] // FOR CHATLIST COMPONENT; 
    public function goBack(){
        $this->selectedChat = false ; 
        $this->userStatus(false);
    }
    

    public function setUserOnline(){
        $this->userStatus(true);
    }
    
    public function setUserOffline(){
        $this->userStatus(false);
    }

    #[On('user-online')] // USER ENTERS CHAT-BOX ; 
    public function userStatus($is_online){
        $user_id = Auth::id();
        $class = class_basename(auth()->user());
        $status = $is_online ? 'online' : 'offline';

        Log::info("User Will be Online to others at channel {$status}.{$class}.{$user_id}");
        auth()->user()->update(['is_online'=>$is_online]);

        // GET ALL CONVERSATIONS I participates at ; 
        $conversations = Conversation::conversationsBetweenParties()->get() ;
        foreach($conversations as $conv){
            $convOtherParty = $conv->otherParty;
            $otherPartyClass = class_basename($convOtherParty);
            Log::info("Broadcasting {$status}-status to: {$otherPartyClass}.{$convOtherParty->id}");
            // BROADCAST STATUS TO OTHER SUBSRIBTIONS ; 
            broadcast(new UserStatus($user_id , $class , $convOtherParty->id , $otherPartyClass , $is_online));
        } 
    }

    public function render()
    {
        return view('livewire.chat.main')
        ->extends($this->layout);
    }
}
