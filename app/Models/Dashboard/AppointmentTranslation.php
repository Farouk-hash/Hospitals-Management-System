<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTranslation extends Model
{
    use HasFactory;
    protected $table = 'appointment_translations';
    protected $fillable = ['name'];

    public $timestamps = false;
   
}
