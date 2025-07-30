<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interface\Doctors\DoctorRepositoryInterface;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected $doctorRepositoryInterface ; 
    public function __construct(DoctorRepositoryInterface $doctorRepositoryInterface){
        $this->doctorRepositoryInterface =$doctorRepositoryInterface ;
    }
    public function index(){
        return $this->doctorRepositoryInterface->index();
    }
    public function create(){
        return $this->doctorRepositoryInterface->create();
    }
    public function store(Request $request){
        return $this->doctorRepositoryInterface->store($request);
    }
    public function destroy(Request $request){
        return $this->doctorRepositoryInterface->destroy($request);
    }
}
