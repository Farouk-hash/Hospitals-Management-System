<?php

namespace App\Models\Dashboard;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    use Translatable;
    public $fillable=['name'];
    protected $table = 'gender';
    public string $translationForeignKey = 'gender_id';

    public $translatedAttributes = ['name'];
}
