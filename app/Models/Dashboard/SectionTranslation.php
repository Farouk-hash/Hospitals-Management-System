<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'description'];

    public $timestamps = false;
    public function sections(){
        return $this->belongsTo(Section::class);
    }
}
