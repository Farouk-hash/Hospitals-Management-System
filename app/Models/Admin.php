<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

     protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // hashing password automatically ; 
    ];

}
