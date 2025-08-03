<?php

namespace App\Repository\Insurance;

use App\Http\Requests\InsuranceRequest;
use App\Interface\Insurance\InsuranceRepositoryInterface;
use App\Models\Dashboard\Insurane as InsuranceModel;
use Illuminate\Http\Request;

class InsuranceRepository implements InsuranceRepositoryInterface
{
    public function index()
    {
        $insurances = InsuranceModel::all();
        return view('dashboard.insurance.index',compact('insurances'));
    }

    public function store(InsuranceRequest $request)
    {   
        $insurance = InsuranceModel::create($request->all());
        $insurance->name = $request->input('name');
        $insurance->notes = $request->input('notes');
        $insurance->save();
        return redirect()->back();
    }

    public function update(InsuranceRequest $request)
    {
        $insurance = InsuranceModel::findorFail($request->input('id'));
        $insurance->update($request->all());
        $insurance->name = $request->input('name');
        $insurance->notes = $request->input('notes');
        $insurance->save();
        return redirect()->back();

    }

    public function destroy(Request $request)
    {
        $insurace = InsuranceModel::findOrFail($request->input('id'));
        $insurace->delete();
        return redirect()->back();
        // return Insurance::destroy($id);
    }
}
