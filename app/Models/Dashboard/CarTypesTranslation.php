<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTypesTranslation extends Model
{
    use HasFactory;
    protected $table = 'car_types_translations';
    protected $fillable = ['name'];
    public $timestamps = false ;
}
