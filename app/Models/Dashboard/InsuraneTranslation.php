<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuraneTranslation extends Model
{
    use HasFactory;
    protected $table='insurance_translations';
    protected $fillable = ['name','notes'];

    public $timestamps = false;
}
