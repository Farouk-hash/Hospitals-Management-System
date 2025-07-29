<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 1. To specify package’s class you are using
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Section extends Model
{
    use HasFactory ; use Translatable ;
    protected $fillable = ['name'];
    public $translatedAttributes = ['name'];

    public function translation(){
        return $this->hasMany(SectionTranslation::class);
    }
}
