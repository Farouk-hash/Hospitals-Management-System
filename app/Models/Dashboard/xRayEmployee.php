<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class xRayEmployee extends Authenticatable
{
    use HasFactory;
    protected $table = 'x_ray_emolyee';
    protected $fillable = ['name','email','email_verified_at','password'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

     protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // hashing password automatically ; 
    ];
    
    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

}
