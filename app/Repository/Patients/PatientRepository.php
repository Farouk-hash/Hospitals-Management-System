<?php

namespace App\Repository\Patients;

use App\Interface\Patients\PatientRepositoryInterface;
use App\Models\Dashboard\Gender;
use App\Models\Dashboard\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientRepository implements PatientRepositoryInterface
{
    public function index()
    {
        $patients = Patient::all();
        return view('dashboard.patients.index',compact('patients'));
    }

    public function create(){
        $gender = Gender::all();
        return view('dashboard.patients.add' , compact('gender'));
    }
    public function store(Request $request)
    {   
        DB::beginTransaction();
        try{
            $patient = Patient::create($request->all(['email','phone_number','birth_date']));
            $patient->name = $request->input('name');
            $patient->notes = $request->input('notes');
            $patient->gender_id = $request->input('gender_id');
            $patient->save();
            DB::commit();
            return redirect()->route('dashboard.patient.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        

    }

    public function destroy(Request $request)
    {
        Patient::destroy($request->input('id'));
        return redirect()->back();
    }
}
