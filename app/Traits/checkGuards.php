<?php 

namespace App\Traits;

use App\Providers\RouteServiceProvider;
use Auth;

trait CheckGuards{
    public function checkGuards(){
           
         
        if (Auth::guard('admin')->check()) {
            return ['value'=>'admin'];
        } elseif (Auth::guard('web')->check()) {
            return ['value'=>'web'];
        }elseif (Auth::guard('doctor')->check()) {
            return  ['value'=>'doctor'];
        }elseif (Auth::guard('ray_employee')->check()) {
            return  ['value'=>'ray_employee'];
        }elseif (Auth::guard('patient')->check()) {
            return  ['value'=>'patient'];
        } else {
            abort(500); // not authenticated
        }
    }
}