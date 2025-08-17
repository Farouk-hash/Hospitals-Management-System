<?php 
namespace App\Repository\Repository_Doctors_Panel;


use App\Interface\Interface_Doctors_Panel\raysRepostioryInterface;
use App\Models\Dashboard\Image;
use App\Models\Dashboard\SingleInvoice;
use App\Models\Doctors_Panel\Rays;
use App\Traits\UploadingImageTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class raysRepository implements raysRepostioryInterface {
    use UploadingImageTraits ; 
    public function index(){
        
        $rays = Rays::all();
        return view('dasboard_rays_employees.rays.index' , compact('rays'));

    }
    public function edit($ray_id){
      
        $ray = Rays::findOrFail($ray_id)->select(['id' , 'notes' ,'employee_notes'])->first();
        return view('dasboard_rays_employees.rays.edit' , compact('ray'));

    }
    public function update(Request $request){
        DB::beginTransaction();
        try{
            $ray_id = $request->input('id') ;
            $ray = Rays::with('diagnostic')->findOrFail($ray_id);
            $ray->update(['employee_notes'=>$request->input('employee_notes')  , 'employee_id'=>Auth::id() , 'rays_status_id'=>2]);

            $invoice_id = $ray->diagnostic->invoice->id ;
            SingleInvoice::findOrFail($invoice_id)->update(['invoices_id'=>1]);

            $this->uploadimage($request , 'image' , 'Rays' , 'upload_image',
            $ray_id , 'App\Models\Doctors_Panel\Rays' , 'ray');

            DB::commit();
            return redirect()->route('rays_employees.rays.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    public function destroy(Request $request){
        try{
            $rayID = $request->input('id');
            $employeeID = Auth::id();
            $ray = Rays::findOrFail($rayID);
            if($ray->employee->id !== $employeeID){
                throw new Exception('INVALID ID');
            }
            // delete images ; 
            $urls = Image::where('imageable_id' , $rayID)->where('imageable_type' , 'App\Models\Doctors_Panel\Rays')->pluck('url')->toArray();
            $this->deleteImage($urls ,'Rays' , 'upload_image' , $rayID , 'App\Models\Doctors_Panel\Rays');
            
            // update rayTable []
            $ray->update(['employee_id'=>null , 'employee_notes'=>null , 'rays_status_id'=>1]);
            return redirect()->route('rays_employees.rays.index');
        }catch(Exception $e){
            abort(403 , $e->getMessage());
        }
    }

    public function show_ray_images(int $ray_id){
        // check if ray_id related to employee_id [AUTH::ID()]
        try{
            $ray = Rays::with(['image'])->findOrFail($ray_id);
            if($ray->employee_id == Auth::id()){
                $images = $ray->image ; 
                $layout = 'dasboard_rays_employees.layouts.master-xray-employee';

                return view('doctors_dashboard.diagnostic.ray_images' ,compact('layout' , 'images') );
            }
            throw new Exception('INVALID ID');
        }catch(Exception $e){
            abort( 403 , $e->getMessage() );
        }
    }

}