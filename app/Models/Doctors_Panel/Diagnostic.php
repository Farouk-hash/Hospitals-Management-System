<?php

namespace App\Models\Doctors_Panel;

use App\Models\Dashboard\SingleInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;
    protected $table = 'diagnostic';
    protected  $fillable = ['diagnostic','drugs','invoice_id'];
    public function invoice(){
        return $this->belongsTo(SingleInvoice::class ,'invoice_id');
    }
    public function Reviews(){
        return $this->hasMany(DiagnosticReviews::class);
    }
}
