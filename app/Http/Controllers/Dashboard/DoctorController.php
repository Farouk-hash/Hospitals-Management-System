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
    public function edit(int $doctor_id){
        return $this->doctorRepositoryInterface->edit($doctor_id);
    }
    public function update(Request $request){
        return $this->doctorRepositoryInterface->update($request);
    }
    public function status(Request $request){
        return $this->doctorRepositoryInterface->status($request);
    }
    public function update_password(Request $request){
        return $this->doctorRepositoryInterface->update_password($request);
    }
}
