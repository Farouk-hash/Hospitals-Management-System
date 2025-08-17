<?php

namespace App\Models\Doctors_Panel;

use App\Models\Dashboard\SingleInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $table = 'lab';
    protected  $fillable  = ['notes','diagnostic_id' , 'lab_status_id'];
    public function diagnostic(){
        return $this->belongsTo(Diagnostic::class , 'diagnostic_id');
    }
    public function status(){
        return $this->belongsTo(InvoiceStatus::class , 'lab_status_id');
    }
}
