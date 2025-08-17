<?php

namespace App\Models\Doctors_Panel;

use App\Models\Dashboard\Image;
use App\Models\Dashboard\xRayEmployee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rays extends Model
{
    use HasFactory;
    protected $table='rays';
    protected $fillable=['notes','diagnostic_id','rays_status_id' ,'employee_id' , 'employee_notes'];
    public function diagnostic(){
        return $this->belongsTo(Diagnostic::class , 'diagnostic_id');
    }
    public function status(){
        return $this->belongsTo(InvoiceStatus::class , 'rays_status_id');
    }
    public function employee(){
        return $this->belongsTo(xRayEmployee::class , 'employee_id');
    }
    public function image(){
        return $this->morphMany(Image::class , 'imageable')->inRandomOrder();
    }
}
