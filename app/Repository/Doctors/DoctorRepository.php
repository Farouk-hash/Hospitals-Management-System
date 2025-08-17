<?php 

namespace App\Repository\Doctors ;

use App\Interface\Doctors\DoctorRepositoryInterface;
use App\Models\Dashboard\Appointment;
use App\Models\Dashboard\Doctor;
use App\Models\Dashboard\Image;
use App\Models\Dashboard\Section;
use App\Traits\ValidateDoctor;
use Exception;
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
        if(session()->has(['section_id'])){
            session()->forget(['section_id']);
        }

        $doctors = Doctor::all();
        return view('dashboard.doctors.index' , compact('doctors'));
    }

    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        $sections = Section::all();
        $appointments = Appointment::all();
        $section_id = session('section_id') ; // true -> remove the drop-down of sections , false ->display them;

        return view('dashboard.doctors.add',
        compact('sections' , 'appointments' , 'section_id'));
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
            $doctor->name = $request->name ;

            // store doctor-appointments [many-to-many Relation];
            $appointments_array = $validated['appointments'];
            $doctor->appointments()->attach($appointments_array);
            $doctor->save();

            $this->uploadimage($request , 'photo' , 'Doctors' , 'upload_image', $doctor->id , 'App\Models\Dashboard\Doctor');
            DB::commit();
            session()->flash('add');
            
            $url = session('section_id') ? 
            route('dashboard.sections.show',session('section_id')) :
            route('dashboard.doctors.index');

            return redirect($url);
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
    }
    public function destroy(Request $request){
        $doctor_id = $request->input('id');
        $doctor = Doctor::findOrFail($doctor_id);

        if($doctor->image){
            $this->deleteImage($doctor->image->url, 'Doctors' , 'upload_image' 
            , $doctor_id , 'App\Models\Dashboard\Doctor' );
        }
        $doctor->delete();
        return redirect()->route('dashboard.doctors.index');
    }
    public function edit(int $doctor_id){
        $sections = Section::all();
        $appointments = Appointment::all();
        $doctor = Doctor::with(['appointments','section','image'])->findOrFail($doctor_id);
        return view('dashboard.doctors.edit',compact('doctor','sections','appointments'));
    }
    public function update(Request $request){
        DB::beginTransaction();
        try{
            $validated = $this->validateDoctor($request , ['password']);
            $doctor_id = $request->input('id');
            // dd($validated);
            $doctor = Doctor::findOrFail($doctor_id);
            $doctor->update([
            'email'=>$validated['email'],
            'phone'=>$validated['phone'],
            'section_id'=>$validated['section_id']]);
            $doctor->name = $validated['name'];
            $appointments_array = $validated['appointments'];
            $doctor->appointments()->sync($appointments_array);
            $doctor->save();

            if($request->hasFile('photo')){
                // remove old one if exists ; 
                if($doctor->image){
                    $this->deleteImage([$doctor->image->url], 'Doctors' , 'upload_image' 
                , $doctor_id , 'App\Models\Dashboard\Doctor' );
                }
                // create new one ; 
                $this->uploadimage($request , 'photo' , 'Doctors' , 'upload_image', $doctor->id , 'App\Models\Dashboard\Doctor');

            }
        DB::commit();
        $url =session('section_id') ? 
            route('dashboard.sections.show',session('section_id')) : route('dashboard.doctors.index');
        
        return redirect($url );
        }catch(Exception $e){
            DB::rollabk();
            dd($e);
        }
       
    }

    public function status(Request $request){
        $doctor_id = $request->input('id');
        $status = $request->input('status');
        Doctor::findOrFail($doctor_id)->update(['status'=>$status]);
        return redirect()->back();
    }

    public function update_password(Request $request){
        $request->validate([
            'password' => 'required|string|min:3|confirmed',
        ]);
        Doctor::findOrFail($request->input('id'))->update(['password'=>$request->input('password')]);
        
        return redirect()->back();
    }

   
}