<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Interface\Interface_Doctors_Panel\DiagnosticRepositoryInfterface;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
     public $diagnosticRepositoryInterface ; 
    public function __construct(DiagnosticRepositoryInfterface $diagnosticRepositoryInterface){
        $this->diagnosticRepositoryInterface = $diagnosticRepositoryInterface ; 
    }
    public function index(){
        return $this->diagnosticRepositoryInterface->index();
    }
    public function store(Request $request){
        return $this->diagnosticRepositoryInterface->store($request);
    }
    public function store_diagnostic_review(Request $request){
        return $this->diagnosticRepositoryInterface->store_diagnostic_review($request);
    }
    public function store_diagnostic_lab(Request $request){
        return $this->diagnosticRepositoryInterface->store_diagnostic_lab($request);
    }
    public function store_diagnostic_ray(Request $request){
        return $this->diagnosticRepositoryInterface->store_diagnostic_ray($request);
    }
    public function show(int $patient_id){
        return $this->diagnosticRepositoryInterface->show($patient_id);
    }
    public function show_ray_images(int $ray_id){
        return $this->diagnosticRepositoryInterface->show_ray_images($ray_id);
    }
}
