<?php
namespace App\Traits;

use App\Models\Dashboard\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
trait UploadingImageTraits
{
    public function uploadimage(Request $request , $input_name, $foldername , $disk ,$imageable_id , $imageable_type ){
        if($request->hasFile($input_name)){
            $file = $request->file($input_name);
            $name = Str::slug($request->input('name'));
            $fileName = $name. '.' . $file->getClientOriginalExtension();

            // insert Image
            Image::Create(['url'=>$fileName , 'imageable_id'=>$imageable_id , 'imageable_type'=>$imageable_type]);
            return $request->file($input_name)->storeAs($foldername, $fileName, $disk);
        }
        return null ; 
    }
}
