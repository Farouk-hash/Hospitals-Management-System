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
    public function uploadimage(
    Request $request,
    $input_name,
    $foldername,
    $disk,
    $imageable_id,
    $imageable_type,
    $request_input_variable = "name"
    ) {
        
        if ($request->hasFile($input_name)) {
            $files = $request->file($input_name);

            // Ensure $files is always an array
            if (!is_array($files)) {
                $files = [$files];
            }

            $name = Str::slug($request->input($request_input_variable));

            foreach ($files as $index => $file) {
                // Make filename unique if multiple files
                $fileName = $name . '-' . time() . '-' . $index . '.' . $file->getClientOriginalExtension();

                // Insert into images table
                Image::create([
                    'url'            => $fileName,
                    'imageable_id'   => $imageable_id,
                    'imageable_type' => $imageable_type
                ]);

                // Store file
                $file->storeAs($foldername, $fileName, $disk);
            }

            return true;
        }

        return null;
    }

    
    /**
     * Summary of deleteImage
     * @param string $file_name
     * @param string $folderName
     * @param string $disk
     * @param int $imageable_id
     * @return bool
     */
    public function deleteImage(array $file_names, $folderName, $disk, $imageable_id, $imageable_type)
    {
        $deletedAll = true;

        foreach ($file_names as $file_name) {
            $file_path = $folderName . '/' . $file_name;

            if (Storage::disk($disk)->exists($file_path)) {
                $deleted = Storage::disk($disk)->delete($file_path);

                if ($deleted) {
                    Image::where('imageable_id', $imageable_id)
                        ->where('imageable_type', $imageable_type)
                        ->delete();
                } else {
                    $deletedAll = false;
                }
            } else {
                $deletedAll = false;
            }
        }

        return $deletedAll;
    }

}
