<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceRequest;
use App\Interface\Insurance\InsuranceRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{

    protected $InsuranceRepositoryInterface ;
    public function __construct(InsuranceRepositoryInterface $InsuranceRepositoryInterface){
        $this->InsuranceRepositoryInterface = $InsuranceRepositoryInterface ; 
    }
    public function index()
    {
        return $this->InsuranceRepositoryInterface->index();
    }

    public function store(InsuranceRequest $request)
    {
        return $this->InsuranceRepositoryInterface->store($request);

    }

  

  
    public function update(InsuranceRequest $request)
    {
        return $this->InsuranceRepositoryInterface->update($request);

    }

  
    public function destroy(Request $request)
    {
        return $this->InsuranceRepositoryInterface->destroy($request);

    }
}
