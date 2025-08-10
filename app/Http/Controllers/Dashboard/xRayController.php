<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interface\xRays\employeeRepositoryInterface;
use Illuminate\Http\Request;

class xRayController extends Controller
{
    
    protected $employeeRepositoryInterface ;
    public function __construct(employeeRepositoryInterface $employeeRepositoryInterface){
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }
    public function index(){
        return $this->employeeRepositoryInterface->index();
    }
    public function create(){
        return $this->employeeRepositoryInterface->create();
    }
    public function store(Request $request){
        return $this->employeeRepositoryInterface->store($request);
    }
    public function destroy(Request $request){
        return $this->employeeRepositoryInterface->destroy($request);
    }
}
