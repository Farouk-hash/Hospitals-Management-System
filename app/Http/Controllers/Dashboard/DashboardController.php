<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::guard('web')->check()){
            $guard = 'web';
        }elseif(Auth::guard('admin')->check()){
            $guard = 'admin';
        }else{
            abort(500);
        }
        $view = ($guard == 'admin') ? "admins" : "users";
        $view = 'dashboard.index_'.$view;
        return view($view );
    }
}
