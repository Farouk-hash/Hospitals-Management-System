<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenderTranslation extends Model
{
    use HasFactory;
    protected $table='gender_translations';
    public $fillable = ['name'];
    public $timestamps = false;
}  
