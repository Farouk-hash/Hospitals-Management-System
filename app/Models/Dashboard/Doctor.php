<?php

namespace App\Models\Dashboard;

use Database\Factories\DoctorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Doctor extends Model
{
    use HasFactory ;
    use Translatable ;
    protected $fillable = ['email','password'];
    public $translatedAttributes = ['name' , 'times'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    public static function newFactory(){
        return new DoctorFactory();
    }
}
