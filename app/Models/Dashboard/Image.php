<?php

namespace App\Models\Dashboard;

use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'imageable_id', 'imageable_type'];
    protected $table = 'image';
    public function imageable() {
        return $this->morphTo();
    }
    public static function newFactory(){
        return new ImageFactory();
    }
}
