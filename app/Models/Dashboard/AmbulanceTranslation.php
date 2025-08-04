<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\CarTypes;
use Illuminate\Database\Eloquent\Model;

class AmbulanceTranslation extends Model
{
    public $timestamps = false;
    protected $table ='ambulance_translations';
    protected $fillable = [
        'driver_name',
        'notes',
        'car_type_id',
    ];

    public function carType()
    {
        return $this->belongsTo(CarTypes::class);
    }
}
