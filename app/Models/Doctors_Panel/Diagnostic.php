<?php

namespace App\Models\Doctors_Panel;

use App\Models\Dashboard\Patient;
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
    
    public function patient()
    {
        return $this->hasOneThrough(
            Patient::class,       // Final related model
            SingleInvoice::class, // Intermediate model
            'id',                 // Foreign key on invoices table (SingleInvoice)...
            'id',                 // Foreign key on patients table...
            'invoice_id',         // Local key on diagnostics table
            'patient_id'          // Local key on invoices table
        );
    }

    public function Reviews(){
        return $this->hasMany(DiagnosticReviews::class);
    }
    public function labs(){
        return $this->hasMany(Lab::class);
    }
    public function rays(){
        return $this->hasMany(Rays::class , 'diagnostic_id');
    }
    

}
