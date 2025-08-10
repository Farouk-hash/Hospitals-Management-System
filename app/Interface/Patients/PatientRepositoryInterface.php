<?php

namespace App\Interface\Patients;

use App\Http\Requests\InsuranceRequest;
use Illuminate\Http\Request;

interface PatientRepositoryInterface
{
    public function index();
    public function show(int $patient_id);
    public function create();
    public function store(Request $request);
    public function update(Request $request);
    public function destroy(Request $request);
}
