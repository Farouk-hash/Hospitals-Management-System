<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interface\Finance\PaymentAccountRepositoryInterface;
use Illuminate\Http\Request;

class PaymentAccountController extends Controller
{
    protected $paymentAccountRepositoryInterface ; 
    public function __construct(PaymentAccountRepositoryInterface $paymentAccountRepositoryInterface){
        $this->paymentAccountRepositoryInterface = $paymentAccountRepositoryInterface ;
    }
    public function index(){
        return $this->paymentAccountRepositoryInterface->index();
    }
    public function create(){
        return $this->paymentAccountRepositoryInterface->create();
    }
    public function store(Request $request){
        return $this->paymentAccountRepositoryInterface->store($request);
    }
    public function edit(int $payment_account_id){
        return $this->paymentAccountRepositoryInterface->edit($payment_account_id);
    } 
    public function update(Request $request){
        return $this->paymentAccountRepositoryInterface->update($request);
    }
    public function destroy(Request $request){
        return $this->paymentAccountRepositoryInterface->destroy($request);
    }
}
