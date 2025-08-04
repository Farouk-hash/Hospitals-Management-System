<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class CarTypes extends Model
{
    use HasFactory;
    use Translatable ;
    protected $table = 'car_types';
    protected $fillable = ['name'];
    public $translatedAttributes = ['name'];
    public string $translationForeignKey = 'car_type_id';


}
