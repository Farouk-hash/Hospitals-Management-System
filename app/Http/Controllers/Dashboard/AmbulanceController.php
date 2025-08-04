<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interface\Ambulance\AmbulanceRepositoryInterface;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{

    protected $AmbulanceRepositoryInterface ;
    public function __construct(AmbulanceRepositoryInterface $AmbulanceRepositoryInterface){
        $this->AmbulanceRepositoryInterface = $AmbulanceRepositoryInterface ; 
    }
    public function index()
    {
        return $this->AmbulanceRepositoryInterface->index();
    }

    public function create(){
        return $this->AmbulanceRepositoryInterface->create();
    }


    
    public function store(Request $request)
    {
        return $this->AmbulanceRepositoryInterface->store($request);

    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->AmbulanceRepositoryInterface->update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->AmbulanceRepositoryInterface->destroy($request);

    }
}
