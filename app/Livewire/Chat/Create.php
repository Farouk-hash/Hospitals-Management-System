<?php

namespace App\Livewire\Chat;

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
    // view-components ;
    public $layout , $title ; 
    public $users , $sender_id , $sender_type , $receiver_type ; 

    protected function setReceiverType($send_to){
        $values = [
            'doctor'=>['model_string'=>'App\Models\Dashboard\Doctor' , 'layout'=>'doctors_dashboard.layouts.master-doctor' , 'title'=>'chatlist-doctors' , 'model'=>Doctor::class] , 
            'ray_employee'=>['model_string'=>'App\Models\Dashboard\xRayEmployee', 'layout'=>'doctors_dashboard.layouts.master-doctor' ,'title'=>'chatlist-xray-employee', 'model'=>xRayEmployee::class],
            'admin'=>['model_string'=>'App\Models\Admin' ,'title'=>'chatlist-admins', 'layout'=>'dashboard.layouts.master', 'model'=>Admin::class]
        ];
        $this->title = $values[$send_to]['title']; // for localization ;
        $this->layout = $values[$send_to]['layout']; // for localization ;

        $this->receiver_type = $values[$send_to]['model_string']; 
        $this->users =   $values[$send_to]['model']::all();
    }
    
    public function mount($send_to){
        if(Auth::guard('doctor')->check()){
            Auth::shouldUse('doctor');
        }
        elseif(Auth::guard('ray_employee')->check()){
            Auth::shouldUse('ray_employee');
        }
        else{
            return redirect()->route('login');
        }
        $this->setReceiverType($send_to);
        $this->sender_id = Auth::id();
        $this->sender_type = get_class(Auth::user());

    }   

    public function createConversation($receiver_id){
        // check if conversation exists ; 
        $conv = Conversation::
        countConversation($this->sender_id , $this->sender_type ,
        $receiver_id ,$this->receiver_type)
        ->count();

        if($conv == 0){
            DB::beginTransaction();
            try{
                Conversation::create(['sender_id'=>$this->sender_id , 'sender_type'=>$this->sender_type ,
                'receiver_id'=>$receiver_id , 'receiver_type'=>$this->receiver_type]);
                DB::commit();
            }catch(Exception $e){
                DB::rollBack();
                dd($e);
            }

        }else{
            dd('conversation exists');
        }
    }   

    public function render()
    {        
        return view('livewire.chat.create')
        ->extends($this->layout);
    }
}
