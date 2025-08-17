<?php

namespace App\Livewire\Chat;

use App\Events\SendMessage;
use App\Models\Chat\Conversation;
use App\Models\Chat\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Log;

class Chatbox extends Component
{

    public $conversationId , $conversation ,$otherPartyInformations;
    // protected $queryString = ['conversationId'];
  
    public function receiveMessage($eventData)
    {
        Log::info('Message received via Echo:', [
            // 'event_data' => $eventData,
            'current_conversation' => $eventData['message']['conversationIDGiven'],
            'conversation_event_data'=>$eventData['message']['conversation_id']
        ]);

        // Check if message belongs to current conversation
        if ($eventData['message']['conversation_id'] == $eventData['message']['conversationIDGiven']) {

            $newReceivedmessage = Message::where('id' , $eventData['message']['id'])->first();
            // Add message to the conversation
            $this->otherPartyInformations['messages'][] = $newReceivedmessage;
        
            // event to show the last message at chatlist for the current-user ; 
            $this->dispatch('lastMessageCurrentUser');
            Log::info('Message added to conversation messages' );
        }
    }
    

    public function boot(){
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

    #[On('chat-selected')]
    public function chatSelected($conversationId){
        $this->conversationId = $conversationId ; 
        $this->conversation = Conversation::findOrFail($conversationId);
        $this->otherPartyInformations = [
            'name'=>$this->conversation->otherParty->name ?? $this->conversation->otherParty->translations()->first()->name,
            'imageUrl'=>$this->conversation->otherPartyImageUrl , 
            'lastSeen'=>$this->conversation->last_seen_message , 
            'messages'=>$this->conversation->messages
        ];
        $this->render();

    }

    #[On('sendMessage')]
    public function sendMessage($message){
        $messageArray = [
        'body'=>$message , 
        'sender_id'=>auth()->id() , 
        'sender_type'=>get_class(auth()->user()),
        'converstaion_id'=>$this->conversationId  , 
        'receiver_id'=>$this->conversation->otherParty->id,
        'receiver_type'=>get_class($this->conversation->otherParty)];

        // append message to the current user ; 
        $newMessage = Message::create($messageArray);
        $this->otherPartyInformations['messages'][] = $newMessage;
            
        // event to show the last message at chatlist for the current-user ; 
        $this->dispatch('lastMessageCurrentUser');
        
        broadcast(new SendMessage($newMessage , $this->conversationId))->toOthers();

    }

    
    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
