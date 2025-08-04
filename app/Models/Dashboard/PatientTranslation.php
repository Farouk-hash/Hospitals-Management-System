<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTranslation extends Model
{
    use HasFactory;
    protected $table = 'patient_translations';
    public $timestamps = false;
    public $fillable = ['name','notes','gender_id'];
    
    public function gender(){
        return $this->belongsTo(Gender::class);
    }
}
