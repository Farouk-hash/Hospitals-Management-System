<?php

namespace App\Livewire\Chat;

use App;
use App\Models\Admin;
use App\Models\Chat\Conversation;
use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\xRayEmployee;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $title, $selectedType = false;
    public $users = [], $send_to, $sender_id, $sender_type, $receiver_type, $conversationID;

    protected function setReceiverType($send_to)
    {
        $values = [
            'doctor' => [
                'model_string' => 'App\Models\Dashboard\Doctor',
                'title' => 'chatlist-doctors',
                'model' => Doctor::class
            ],
            'ray_employee' => [
                'model_string' => 'App\Models\Dashboard\xRayEmployee',
                'title' => 'chatlist-xray-employee',
                'model' => xRayEmployee::class
            ],
            'admin' => [
                'model_string' => 'App\Models\Admin',
                'title' => 'chatlist-admins',
                'model' => Admin::class
            ]
        ];

        $this->title = $values[$send_to]['title'];
        $this->receiver_type = $values[$send_to]['model_string'];
        $this->users = $values[$send_to]['model']::all();
    }

    public function mount()
    {
        if (Auth::guard('doctor')->check()) {
            Auth::shouldUse('doctor');
        } elseif (Auth::guard('ray_employee')->check()) {
            Auth::shouldUse('ray_employee');
        } else {
            return redirect()->route('login');
        }
        
        $this->sender_id = Auth::id();
        $this->sender_type = get_class(Auth::user());
    }

    public function loadUsersByType($userTypeSelected)
    {
        $this->selectedType = true; // Remove Buttons For Selecting UsersTypes ; 
        $this->send_to = $userTypeSelected; 
        $this->setReceiverType($this->send_to);
    }

    public function createConversation($receiver_id)
    {
        // Check if conversation exists
        $conv = Conversation::countConversation(
            $this->sender_id,
            $this->sender_type,
            $receiver_id,
            $this->receiver_type
        );

        if ($conv->count() == 0) {
            DB::beginTransaction();
            try {
                $conversation = Conversation::create([
                    'sender_id' => $this->sender_id,
                    'sender_type' => $this->sender_type,
                    'receiver_id' => $receiver_id,
                    'receiver_type' => $this->receiver_type
                ]);
                DB::commit();
                $this->conversationID = $conversation->id;
            } catch (Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Failed to create conversation');
                return;
            }
        } else {
            $this->conversationID = $conv->first()->id;
        }

       // Dispatch to parent component
        $this->dispatch('conversationCreated', $this->conversationID);
    }

    public function render()
    {
        return view('livewire.chat.create');
    }
}