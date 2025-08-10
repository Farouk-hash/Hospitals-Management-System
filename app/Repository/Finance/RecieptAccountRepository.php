<?php

namespace App\Repository\Finance;

use App\Interface\Finance\RecieptAccountRepositoryInterface;
use App\Models\Dashboard\FundAccount;
use App\Models\Dashboard\PatientAccount;
use App\Models\Dashboard\RecieptAccount;
use App\Models\Dashboard\SingleInvoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecieptAccountRepository implements RecieptAccountRepositoryInterface
{
    public function index()
    {
        $recieptAccounts = RecieptAccount::get();
        return view('dashboard.PromissoryBond.index',compact('recieptAccounts'));
    }

    public function show(int $receiept_account_id){
        $recieptAccounts = RecieptAccount::with('patient')->findOrFail($receiept_account_id);
        return view('dashboard.PromissoryBond.print', compact('recieptAccounts'));
    }
    public function create(){
        $singleInvoicesPromissories = SingleInvoice::where('payment_type_id',2)->get();
        return view('dashboard.PromissoryBond.create' , compact('singleInvoicesPromissories'));
    }

    // protected function checkPatientAccountAmount($patient_id){
    //     $singleInvoice = SingleInvoice::where('patient_id' , $patient_id)->select('id')->get();
    //     dd($singleInvoice);
    //     $total_debit = PatientAccount::where('patient_id' , $patient_id)->sum('debit');
    //     $total_credit = PatientAccount::where('patient_id',$patient_id)->sum('credit');
    //     dd($total_debit , $total_credit);
    // }

    public function store(Request $request)
    {   
        DB::beginTransaction();
        try{
            // store at ReceieptAccount [patient_id , debit , notes] ; 
            $receipt_account = RecieptAccount::create($request->all());
            $receiept_account_id = $receipt_account->id ; 
            // store at FundAccount ; [debit = value , credit = 0];
            FundAccount::create(['reciept_id'=>$receiept_account_id , 'debit'=>$request->input('debit') , 'credit'=>0]);
            // store at PatientAccount ; [debit = 0 , credit = value , reciept_id = $this->reciept_id]
            PatientAccount::create(['reciept_id'=>$receiept_account_id,'debit'=>0 ,
            'credit'=>$request->input('debit')]);
            DB::commit();
            return redirect()->route('dashboard.finance_promissory.index');

        }
        catch(Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->back()->withErrors(['message'=>'Invalid Data' , 'details'=>$e]);
        }
    }

    public function edit(int $receiept_account_id){

        $receieptAccount = RecieptAccount::findOrFail($receiept_account_id,['id','debit','notes','created_at']);
        $singleInvoicesPromissories = SingleInvoice::where('payment_type_id',2)->get();
        return view('dashboard.PromissoryBond.edit' , compact('receieptAccount','singleInvoicesPromissories'));
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            $receieptAccountID = $request->input('id');
            $receieptAccount = RecieptAccount::findOrFail($receieptAccountID);
            $receieptAccount->update(['debit'=>$request->input('debit'),'notes'=>$request->input('notes')]);
            
            FundAccount::where('reciept_id',$receieptAccountID)->update(['debit'=>$request->input('debit')]);
            PatientAccount::where('reciept_id',$receieptAccountID)->update(['credit'=>$request->input('debit')]);
            DB::commit();
            return redirect()->route('dashboard.finance_promissory.index');
        }catch(Exception $e){
            dd($e);
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
       RecieptAccount::destroy($request->input('id'));
       return redirect()->back();
    }
}
