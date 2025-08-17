<?php 
namespace App\Repository\Repository_Doctors_Panel;

use App\Interface\Interface_Doctors_Panel\DiagnosticRepositoryInfterface;
use App\Models\Dashboard\Patient;
use App\Models\Dashboard\SingleInvoice;
use App\Models\Doctors_Panel\Diagnostic;
use App\Models\Doctors_Panel\DiagnosticReviews;
use App\Models\Doctors_Panel\Lab;
use App\Models\Doctors_Panel\Rays;
use App\Traits\UploadingImageTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DiagnosticRepository implements DiagnosticRepositoryInfterface{
    use UploadingImageTraits ; 
    public function index(){
        return view('doctors_dashboard.diagnostic.index');
    }
    public function store(Request $request){
        DB::beginTransaction();
        try{
            Diagnostic::create($request->all());
            SingleInvoice::findOrFail($request->input('invoice_id'));
            $this->update_invoice_status($request->input('invoice_id') , 2);
            DB::commit();
            return redirect()->route('doctors_dashboard.doctors.index');   
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
        
    }
    public function store_diagnostic_review(Request $request){
        DB::beginTransaction();
        try{
            DiagnosticReviews::create(['diagnostic_id'=>$request->input('diagnostic_id') , 'notes'=>$request->input('notes')]);
            $this->update_invoice_status($request->input('invoice_id') , 3);
            DB::commit();
            return redirect()->route('doctors_dashboard.doctors.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
            
    }
    public function store_diagnostic_lab(Request $request){
        DB::beginTransaction();
        try{
            $invoice_id = $request->input('invoice_id');
            Lab::create(['diagnostic_id'=>$request->input('diagnostic_id') , 'notes'=>$request->input('notes') , 'lab_status_id'=>1]);
            $this->update_invoice_status($invoice_id , 3);
            DB::commit();
            return redirect()->route('doctors_dashboard.doctors.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }
    public function store_diagnostic_ray(Request $request){
        DB::beginTransaction();
        try{
            Rays::create(['notes'=>$request->input('notes') , 
            'diagnostic_id'=>$request->input('diagnostic_id'),'rays_status_id'=>3 ]);
            $this->update_invoice_status($request->input('invoice_id') , 3);
            DB::commit();
            return redirect()->route('doctors_dashboard.doctors.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    protected function update_invoice_status($invoice_id , $status){
        $invoice = SingleInvoice::findOrFail($invoice_id);
        $invoice->update(['invoices_id'=>$status]);
    }
    
    public function show(int $patient_id){
        
        $invoicesIDS = SingleInvoice::where('patient_id' , $patient_id)
        ->where('doctor_id' , Auth::id())
        ->pluck('id');
        if($invoicesIDS->count() == 0 ){
            abort(403,'INVALID ID');
        }
        $diagnostics = Diagnostic::with(['invoice','Reviews' ,'labs' ,'patient' , 'rays'])->whereIn('invoice_id',$invoicesIDS)
        ->select('diagnostic' , 'drugs' , 'created_at','invoice_id' , 'id')
        ->get();

        $labs = $diagnostics->pluck('labs')->flatten();
        $rays = $diagnostics->pluck('rays')->flatten();
        $patient = $diagnostics->first()->patient;;

        return view('doctors_dashboard.diagnostic.show' , compact('diagnostics' ,'labs', 'rays','patient'));
    }
    public function show_ray_images(int $ray_id){
        // check if ray_id related to doctor_id [AUTH::ID()]
        try{
            $ray = Rays::with(['image' , 'diagnostic'])->findOrFail($ray_id);
            if($ray->diagnostic->invoice->doctor_id == Auth::id()){
                $images = $ray->image ; 
                $layout = 'doctors_dashboard.layouts.master-doctor';
                return view('doctors_dashboard.diagnostic.ray_images' ,compact('layout','images') );
            }
            throw new Exception('INVALID ID');
        }catch(Exception $e){
            abort( 403 , $e->getMessage()   );
        }
    }
}