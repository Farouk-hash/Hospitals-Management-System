<?php

namespace App\Repository\Ambulance;

use App\Interface\Ambulance\AmbulanceRepositoryInterface;
use App\Models\Dashboard\Ambulance;
use App\Models\Dashboard\CarTypes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {

        $ambulances = Ambulance::all();
        return view('dashboard.ambulance.index',compact('ambulances'));
    }
    public function create(){
        $car_types = CarTypes::all();
        return view('dashboard.ambulance.add',compact('car_types'));
    }
    public function store(Request $request)
    {   
        DB::beginTransaction();
        try{
            $ambulance = Ambulance::create($request->all(['car_number','car_model','published_at','phone_number','licence_car_number']));
            $ambulance->driver_name = $request->input('driver_name');
            $ambulance->notes = $request->input('notes');
            $ambulance->car_type_id = $request->input('car_type_id');
            $ambulance->save();
            DB::commit();
            return redirect()->route('dashboard.ambulance.index');
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back();
        }
       
    }

    public function update(Request $request)
    {
        

    }

    public function destroy(Request $request)
    {
        Ambulance::destroy($request->input('id'));
        return redirect()->back();
    }
}
