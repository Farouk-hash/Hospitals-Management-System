<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   
    public function user_index(){
        if(Auth::guard('web')->check()){
            return view('dashboard.index_users');
        }
        abort(500);
    }
    public function admin_index(){
        if(Auth::guard('admin')->check()){
            return view('dashboard.index_admins');
        }
        abort(500);
    }
    public function doctor_index(){
        if(Auth::guard('doctor')->check()){
            return view('doctors_dashboard.index');
        }
        abort(500);
    }

    public function xrayemployee_index(){
        if(Auth::guard('xray_employee')->check()){
            return view('dasboard_rays_employees.index');
        }
        abort(500);
    }
}
