<?php

namespace App\Models\Dashboard;

use Database\Factories\ServicesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Services extends Model
{
    use HasFactory ; use Translatable ;
    protected $fillable = ['name','price' , 'status'];
    public $translatedAttributes = ['name'];
    
    public static function newFactory(){
        return new ServicesFactory();
    }
    public function translation(){
        return $this->hasMany(ServicesTranslation::class);
    }
    public function service_group()
    {
        return $this->belongsToMany(groupServices::class,'group_pivot_services' , 'service_id','group_id');
    }
}
