<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interface\Finance\RecieptAccountRepositoryInterface;
use Illuminate\Http\Request;

class RecieptAccountController extends Controller
{
    protected $RecieptAccountRepositoryInterface ;
    public function __construct(RecieptAccountRepositoryInterface $RecieptAccountRepositoryInterface){
        $this->RecieptAccountRepositoryInterface = $RecieptAccountRepositoryInterface ; 
    }
    public function index(){
        return $this->RecieptAccountRepositoryInterface->index();
    }
    public function create(){
        return $this->RecieptAccountRepositoryInterface->create();
    }
    public function store(Request $request){
        return $this->RecieptAccountRepositoryInterface->store($request);
    }
    public function edit(int $receiept_account_id){
        return $this->RecieptAccountRepositoryInterface->edit($receiept_account_id);
    } 
    public function update(Request $request){
        return $this->RecieptAccountRepositoryInterface->update($request);
    }
    public function destroy(Request $request){
        return $this->RecieptAccountRepositoryInterface->destroy($request);
    }
    public function show(int $receiept_account_id){
        return $this->RecieptAccountRepositoryInterface->show($receiept_account_id);
    }
}
