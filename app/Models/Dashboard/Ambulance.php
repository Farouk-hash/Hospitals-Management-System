<?php

namespace App\Models\Dashboard;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

class Ambulance extends Model
{
    use HasFactory, Translatable;
    protected $table = 'ambulance';
    protected $fillable = [
        'car_number',
        'car_model',
        'published_at',
        'phone_number',
        'licence_car_number',
    ];

  
    public $translatedAttributes = ['driver_name', 'notes','car_type_id'];
  
}
