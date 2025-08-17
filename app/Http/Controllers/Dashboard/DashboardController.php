<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\SingleInvoice;
use App\Traits\CheckGuards;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    use CheckGuards ;
    public function user_index(){
        $this->checkGuards(); // value of guard OR abort(500) NOT AUTHENTICATED ;
            return view('dashboard.index_users');
        
    }
    public function admin_index(){
        $this->checkGuards(); // value of guard OR abort(500) NOT AUTHENTICATED ;
        return view('dashboard.index_admins');
        
    }
    public function doctor_index(){
        $this->checkGuards(); // value of guard OR abort(500) NOT AUTHENTICATED ;
        $invoicesStates = SingleInvoice::where('doctor_id', Auth::id())
            ->selectRaw("
                SUM(CASE WHEN invoices_id = 1 THEN 1 ELSE 0 END) as uncompleted,
                SUM(CASE WHEN invoices_id = 2 THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN invoices_id = 3 THEN 1 ELSE 0 END) as review,
                SUM(CASE WHEN payment_type_id = 1 THEN 1 ELSE 0 END) as cash,
                SUM(CASE WHEN payment_type_id = 2 THEN 1 ELSE 0 END) as promissory
            ")
            ->first()
            ->toArray();
            return view('doctors_dashboard.index' , compact('invoicesStates'));
    }

    

    public function xrayemployee_index(){
        $this->checkGuards(); // value of guard OR abort(500) NOT AUTHENTICATED ;
        return view('dasboard_rays_employees.index');
        
    }
    
    public function patient_index(){
        $this->checkGuards(); // value of guard OR abort(500) NOT AUTHENTICATED ;
        return view('dashboard_patient.index');
    }
}
