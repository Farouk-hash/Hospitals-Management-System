<?php 
namespace App\Repository\Repository_Doctors_Panel;

use App\Interface\Interface_Doctors_Panel\DiagnosticRepositoryInfterface;
use App\Models\Dashboard\Patient;
use App\Models\Dashboard\SingleInvoice;
use App\Models\Doctors_Panel\Diagnostic;
use App\Models\Doctors_Panel\DiagnosticReviews;
use App\Models\Doctors_Panel\Lab;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DiagnosticRepository implements DiagnosticRepositoryInfterface{
    public function index(){
        return view('doctors_dashboard.diagnostic.index');
    }
    public function store(Request $request){
        DB::beginTransaction();
        try{
            Diagnostic::create($request->all());
            $invoice = SingleInvoice::findOrFail($request->input('invoice_id'));
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
            Lab::create(['invoice_id'=>$invoice_id , 'notes'=>$request->input('notes')]);
            $this->update_invoice_status($invoice_id , 3);
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
        $invoicesIDS = SingleInvoice::where('patient_id' , $patient_id)->pluck('id');
        $diagnostics = Diagnostic::with(['invoice','Reviews'])->whereIn('invoice_id',$invoicesIDS)
        ->select('diagnostic' , 'drugs' , 'created_at','invoice_id' , 'id')
        ->get();
        $labs = Lab::with(['invoice'])->whereIn('invoice_id',$invoicesIDS)
        ->select('notes', 'created_at','invoice_id' , 'id')
        ->get();
        $patient = Patient::findOrFail($patient_id);
        return view('doctors_dashboard.diagnostic.show' , compact('diagnostics' , 'labs' , 'patient'));
    }
}