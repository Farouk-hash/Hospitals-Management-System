<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Insurane extends Model
{
    use HasFactory;
    use Translatable ;
    protected $table='insurance';
    protected $fillable = ['insurance_code','patient_discount','patient_discount','insurance_discount'];
    public $translatedAttributes = ['name','notes'];
    
}
