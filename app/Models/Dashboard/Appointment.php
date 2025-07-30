<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Appointment extends Model
{
    use HasFactory ; 
    use Translatable ;
    protected $table = 'appointment';
    protected $fillable = ['name'];
    public $translatedAttributes = ['name'];
    
    public function translation(){
        return $this->hasMany(AppointmentTranslation::class);
    }
    
}
