<?php

namespace App\Models\Doctors_Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticReviews extends Model
{
    use HasFactory;
    public $fillable=['notes' , 'diagnostic_id'];
    public function diagnostic(){
        return $this->belongsTo(Diagnostic::class , 'diagnostic_id');
    }
}
