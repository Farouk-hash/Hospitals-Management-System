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

  

    /**
     * Update the specified resource in storage.
     */
    public function update(InsuranceRequest $request)
    {
        return $this->InsuranceRepositoryInterface->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->InsuranceRepositoryInterface->destroy($request);

    }
}
