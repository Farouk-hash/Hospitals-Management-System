<?php 

namespace App\Repository\Doctors ;

use App\Interface\Doctors\DoctorRepositoryInterface;
use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\Section;
use Illuminate\Http\Request;
use App\Traits\UploadingImageTraits;
use Illuminate\Support\Facades\DB;

class DoctorRepository implements DoctorRepositoryInterface{
    use UploadingImageTraits;
    public function index(){
        $doctors = Doctor::all();
        return view('dashboard.doctors.index' , compact('doctors'));
    }
    public function create(){
        $sections = Section::all();
        return view('dashboard.doctors.add',compact('sections'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:3',
            'phone' => 'required|string|max:15',
            'section_id' => 'required|exists:sections,id',
            'appointments' => 'required|array|min:1',
            'appointments.*' => 'string',
            // 'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        DB::beginTransaction() ;
        try{
            $doctor = Doctor::create([
            'email'=>$validated['email'],'section_id'=>$validated['section_id'],
            'phone'=>$validated['phone'],'password'=>$validated['password']]);
          
            // store trans
            $doctor->name = $request->name;
            $doctor->times =implode(",",$request->appointments);
            $doctor->save();
            $this->uploadimage($request , 'photo' , 'Doctors' , 'upload_image', $doctor->id , 'App\Models\Dashboard\Doctor');
            DB::commit();
            session()->flash('add');
            return redirect()->route('dashboard.doctors.index');
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
    }
}