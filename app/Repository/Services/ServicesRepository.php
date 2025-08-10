<?php

namespace App\Repository\Services;

use App\Http\Requests\ServiceValidatedRequest;
use App\Interface\Services\ServicesRepositoryInterface;
use App\Models\Dashboard\Services;
use Illuminate\Http\Request;

class ServicesRepository implements ServicesRepositoryInterface
{
    public function index()
    {
        $services = Services::all();
        return view('dashboard.services.single-service.index',compact('services'));
    }

    public function find($id)
    {
        return Services::findOrFail($id);
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'name'  => ['string', 'required'],
            // 'description'=>['string','required'],
            'price' => ['required', 'numeric', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
        ]);
        $service = new Services();
        $service->price = $validated['price'];
        $service->name = $validated['name'];
        $service->save();
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $service = Services::findOrFail($id);
        $service->update(['name'=>$request->input('name'),'price'=>$request->input('price'),'status'=>$request->input('status')]);
        return  redirect()->back();
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Services::destroy($id);
        return redirect()->back();
    }
}