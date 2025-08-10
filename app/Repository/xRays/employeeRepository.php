<?php 
namespace App\Repository\xRays;

use App\Interface\xRays\employeeRepositoryInterface;
use App\Models\Dashboard\xRayEmployee;
use App\Traits\UploadingImageTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class employeeRepository implements employeeRepositoryInterface{
    use UploadingImageTraits;

    public function index(){
        $raysEmployees = xRayEmployee::all();
        return view('dashboard.rays.index' ,compact('raysEmployees') );
    }
    public function create(){
        return view('dashboard.rays.add');
    }
    public function store(Request $request){
        DB::beginTransaction();
        try{
            $xrayEmployee = xRayEmployee::create($request->all());       
            $this->uploadimage($request , 'photo' , 'xRayEmployee' , 'upload_image',$xrayEmployee->id , 'App\Models\Dashboard\xRayEmployee');
            DB::commit();
            return redirect()->route('dashboard.employees.xrays.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }
    public function destroy(Request $request){
        xRayEmployee::destroy($request->input('id'));
        return redirect()->back();
    }
    
}