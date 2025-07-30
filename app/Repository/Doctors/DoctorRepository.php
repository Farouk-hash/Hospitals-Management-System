<?php 

namespace App\Repository\Doctors ;

use App\Interface\Doctors\DoctorRepositoryInterface;
use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\Section;
use App\Traits\ValidateDoctor;
use Illuminate\Http\Request;
use App\Traits\UploadingImageTraits;
use Illuminate\Support\Facades\DB;

class DoctorRepository implements DoctorRepositoryInterface{
    use UploadingImageTraits;
    use ValidateDoctor;
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $doctors = Doctor::all();
        return view('dashboard.doctors.index' , compact('doctors'));
    }
    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        $sections = Section::all();
        return view('dashboard.doctors.add',compact('sections'));
    }
    /**
     * Summary of store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $validated = $this->validateDoctor($request);
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

    public function edit(){

    }
    public function update(){

    }
    public function destroy(){
         
    }
}