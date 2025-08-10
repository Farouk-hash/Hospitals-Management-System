<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interface\Patients\PatientRepositoryInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $PatientRepositoryInterface ;
    public function __construct(PatientRepositoryInterface $PatientRepositoryInterface){
        $this->PatientRepositoryInterface = $PatientRepositoryInterface ; 
    }
    public function index()
    {
        return $this->PatientRepositoryInterface->index();
    }
    public function show(int $patient_id){
        return $this->PatientRepositoryInterface->show($patient_id);
    }
    public function create(){
        return $this->PatientRepositoryInterface->create();
    }
    public function store(Request $request)
    {
        return $this->PatientRepositoryInterface->store($request);

    }

  
    public function update(Request $request)
    {
        return $this->PatientRepositoryInterface->update($request);

    }

  
    public function destroy(Request $request)
    {
        return $this->PatientRepositoryInterface->destroy($request);

    }
}
