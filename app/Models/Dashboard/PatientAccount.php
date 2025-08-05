<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;
    
    protected $fillable = ['single_invoice_id','reciept_id','debit','credit'];
    protected $table = 'patient_account';
}
