<?php

namespace App\Models\Dashboard;

use Database\Factories\SectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 1. To specify package’s class you are using
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Section extends Model
{
    use HasFactory ; use Translatable ;
    protected $fillable = ['name' , 'description'];
    public $translatedAttributes = ['name' , 'description'];
    public static function newFactory(){
        return new SectionFactory();
    }
    public function translation(){
        return $this->hasMany(SectionTranslation::class);
    }
    public function doctors(){
        return $this->hasMany(Doctor::class);
    }
}
