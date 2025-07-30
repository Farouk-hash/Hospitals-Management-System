<?php
namespace App\Traits;

use App\Models\Dashboard\Image;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
trait UploadingImageTraits
{
    /**
     * Summary of uploadimage
     * @param \Illuminate\Http\Request $request
     * @param string $input_name
     * @param string $foldername
     * @param string $disk
     * @param int $imageable_id
     * @param string $imageable_type
     * @return string|null
     */
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
    
    /**
     * Summary of deleteImage
     * @param string $file_name
     * @param string $folderName
     * @param string $disk
     * @param int $imageable_id
     * @return bool
     */
    public function deleteImage($file_name, $folderName , $disk , $imageable_id  , $imageable_type)
    {
        $file_path = $folderName . '/' . $file_name;

        if (Storage::disk($disk)->exists($file_path)) {
            
            $deleted = Storage::disk($disk)->delete($file_path);

            Image::where('imageable_id', $imageable_id)
                ->where('imageable_type', $imageable_type)
                ->delete();


            return $deleted;
        }

        return false;
    }
}
