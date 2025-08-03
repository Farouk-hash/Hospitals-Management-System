<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class groupServices extends Model
{
    use HasFactory;
    use Translatable ;

    protected $fillable = ['price_before_discount','discount','taxes','total_price','status'];
    public $translatedAttributes = ['name','notes'];
    public function translations(){
        return $this->hasMany(groupServicesTranslation::class);
    }
    public function service_group()
    {
        return $this->belongsToMany(Services::class,'group_pivot_services');
    }
    
}
