<?php

namespace App\Repository\Patients;

use App\Interface\Patients\PatientRepositoryInterface;
use App\Models\Dashboard\Gender;
use App\Models\Dashboard\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientRepository implements PatientRepositoryInterface
{
    public function index()
    {
        $patients = Patient::all();
        return view('dashboard.patients.index',compact('patients'));
    }

    public function show(int $patient_id){
        $patient = Patient::with(['singleInvoices','receieptAccount','paymentAccount'])->findOrFail($patient_id);
        
        $invoices = $patient->singleInvoices->where('payment_type_id', 2)
        ->map(function($invoice){
            return [
                'amount'=>$invoice->total_price , 
                'notes'=>$invoice->service->name ?? $invoice->service->translations->first()->name ,
                'type'=>'invoice' , 
                'created_at'=>$invoice->created_at
            ];
        }); 
        $receiepts = $patient->receieptAccount
        ->map(function($receiept){
            return [
                'amount'=>$receiept->debit , 
                'notes'=>$receiept->notes ,
                'type'=>'promissory_bond_title' , 
                'created_at'=>$receiept->created_at
            ];
        });  
        $paymentAccounts = $patient->paymentAccount ->map(function($paymentAccount){
        return [
                'amount'=>$paymentAccount->credit , 
                'notes'=>$paymentAccount->notes ,
                'type'=>'payment_account_title' , 
                'created_at'=>$paymentAccount->created_at
            ];
        });   // PAYMENT BONDS [CREDIT]; 

        $allTransactions = collect()
        ->merge($invoices)
        ->merge($receiepts)
        ->merge($paymentAccounts);

        return view('dashboard.patients.show',compact('patient' , 'allTransactions'));
    }
    public function create(){
        $gender = Gender::all();
        return view('dashboard.patients.add' , compact('gender'));
    }
    public function store(Request $request)
    {   
        DB::beginTransaction();
        try{
            $patient = Patient::create($request->all(['email','phone_number','birth_date']));
            $patient->name = $request->input('name');
            $patient->notes = $request->input('notes');
            $patient->gender_id = $request->input('gender_id');
            $patient->save();
            DB::commit();
            return redirect()->route('dashboard.patient.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        

    }

    public function destroy(Request $request)
    {
        Patient::destroy($request->input('id'));
        return redirect()->back();
    }
}
