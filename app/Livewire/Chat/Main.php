<?php

namespace App\Livewire\Chat;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{
    
    // view-components ;
    public $layout  ; 

    public function mount(){
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
    public function render()
    {
        return view('livewire.chat.main')
        ->extends($this->layout);
    }
}
