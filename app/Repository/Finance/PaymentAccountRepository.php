<?php

namespace App\Repository\Finance;

use App\Interface\Finance\PaymentAccountRepositoryInterface;
use App\Models\Dashboard\FundAccount;
use App\Models\Dashboard\PatientAccount;
use App\Models\Dashboard\PaymentAccount;
use App\Models\Dashboard\RecieptAccount;
use App\Models\Dashboard\SingleInvoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentAccountRepository implements PaymentAccountRepositoryInterface
{
    public function index()
    {
        $paymentAccounts = PaymentAccount::get();
        return view('dashboard.PaymentAccount.index',compact('paymentAccounts'));
    }

    public function create(){
        $singleInvoicesPromissories = SingleInvoice::where('payment_type_id',2)->get();
        foreach($singleInvoicesPromissories as $index => $value){
            $patient_id = $value->patient_id ;
            $singleInvoicesPromissories[$index]['remaningAmountForPatient'] =  $this->calcaulteAmountForPatients($patient_id);  
        }
        return view('dashboard.PaymentAccount.create' , compact('singleInvoicesPromissories'));
    }
    public function edit(int $payment_account_id){
        $paymentAccount = PaymentAccount::
        with(['patient'])->findOrFail($payment_account_id,['id','credit','notes','patient_id','created_at']);
        $remaningAmountForPatient = $this->calcaulteAmountForPatients($paymentAccount->patient->id);  
        $paymentAccount['remaningAmountForPatient']=$remaningAmountForPatient ; 
        return view('dashboard.PaymentAccount.edit' , compact('paymentAccount'));
    }
    protected function calcaulteAmountForPatients($patient_id){
        $singleInvoice = SingleInvoice::where('patient_id',$patient_id)->pluck('id'); 
        $recieptAccount = RecieptAccount::where('patient_id',$patient_id)->pluck('id'); 
        $paytmentAccount = PaymentAccount::where('patient_id',$patient_id)->pluck('id'); 

        [$total_debits , $total_credit , $total_payment] = 
            [
                PatientAccount::whereIn('single_invoice_id',$singleInvoice)->sum('debit'),
                PatientAccount::whereIn('reciept_id',$recieptAccount)->sum('credit'),
                PatientAccount::whereIn('payment_account_id',$paytmentAccount)->sum('debit'),
            ];
        return $total_debits - ($total_payment+$total_credit);
    
    }
   
     public function store(Request $request)
     {   
        DB::beginTransaction();
        try{
            if($request->input('credit_remaning') < $request->input('credit')){
                throw new Exception("Credit Bigger Than Debit :(", 1);
            }
            // store at PaymentAccount [patient_id , debit , notes] ; 
            $payment_account = PaymentAccount::create($request->all());
            $payment_account_id = $payment_account->id ; 
            // store at FundAccount ; [debit = 0 , credit = value];
            FundAccount::create(['payment_account_id'=>$payment_account_id , 'debit'=>0, 'credit'=>$request->input('credit') ]);
            // store at PatientAccount ; [debit = 0 , credit = value , reciept_id = $this->reciept_id]
            PatientAccount::create(['payment_account_id'=>$payment_account_id,'debit'=>$request->input('credit') ,
            'credit'=>0]);
            DB::commit();
            return redirect()->route('dashboard.finance_payment_account.index');

        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['message'=>'Invalid Data' , 'details'=>$e->getMessage()]);
        }
     }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            if($request->input('credit') > ($request->input('credit_allowed') + $request->input('credit_remaning')) ){
                throw new Exception("Credit Bigger Than Debit :(", 1);
            }
            $paymentAccountID = $request->input('id');
            $paymentAccount = PaymentAccount::findOrFail($paymentAccountID);
            $paymentAccount->update(['credit'=>$request->input('credit'),'notes'=>$request->input('notes')]);
            
            FundAccount::where('payment_account_id',$paymentAccountID)
            ->update(['credit'=>$request->input('credit')]);
            PatientAccount::where('payment_account_id',$paymentAccountID)
            ->update(['debit'=>$request->input('credit')]);
            DB::commit();
            return redirect()->route('dashboard.finance_payment_account.index');
        }catch(Exception $e){
            return redirect()->back()
            ->withErrors(['message'=>'Invlaid Creditanitals',
            'e'=>$e->getMessage()]);
        }
     }

     public function destroy(Request $request)
     {
       PaymentAccount::destroy($request->input('id'));
       return redirect()->back();
     }
}
