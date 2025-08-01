<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public $timestamps = false;
    public function sections(){
        return $this->belongsTo(Doctor::class);
    }
}
