<?php

namespace App\Models\Dashboard;

use App\Models\Doctors_Panel\Diagnostic;
use App\Models\Doctors_Panel\InvoiceStatus;
use App\Models\Doctors_Panel\Lab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleInvoice extends Model
{
    use HasFactory;
     protected $table = 'single_invoice';

    protected $fillable = [
        'doctor_id',
        'service_id',
        'section_id',
        'payment_type_id',
        'patient_id',
        'service_price',
        'discount',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total_price',
        'invoices_id'
    ];
     public function diagnostics(){
        return $this->hasMany(Diagnostic::class , 'invoice_id' , 'id');
    }
  
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function service()
    {
        return $this->belongsTo(Services::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function patient(){
        return $this->belongsTo(Patient::class , 'patient_id');
    }
    public function payment_type(){
        return $this->belongsTo(PaymentTypes::class , 'payment_type_id');
    }
    public function invoiceStatus(){
        return $this->belongsTo(InvoiceStatus::class , 'invoices_id');
    }
   
}
