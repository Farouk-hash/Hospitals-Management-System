<?php 

namespace App\Interface\Doctors;

use Illuminate\Http\Request;

interface DoctorRepositoryInterface{

    public function index();
    public function create();
    public function store(Request $request);
    public function destroy(Request $request);
    public function edit();
    public function update(Request $request);
}