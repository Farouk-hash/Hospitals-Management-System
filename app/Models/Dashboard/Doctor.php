<?php

namespace App\Models\Dashboard;

use Database\Factories\DoctorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory ;
    use Translatable ;

    protected $fillable = ['email','password' ,'section_id', 'phone','status' , 'is_online'];
    public $translatedAttributes = ['name'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public static function newFactory(){
        return new DoctorFactory();
    }

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function translation(){
        return $this->hasMany(DoctorTranslation::class);
    }

    public function appointments(){
        return $this->belongsToMany(Appointment::class , 'doctor_appointments');
    }

}
