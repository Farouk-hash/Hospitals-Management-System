<?php 

namespace App\Interface\Doctors;

use Illuminate\Http\Request;

interface DoctorRepositoryInterface{

    public function index();
    public function create(); // create-form;
    public function store(Request $request);
    public function destroy(Request $request);
    public function edit(int $doctor_id); // edit-form ; 
    public function update(Request $request);
    public function status(Request $request);
    public function update_password(Request $request);
}