<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    use HasFactory;
    protected $fillable = ['credit','notes','patient_id'];
    protected $table = 'payment_account';
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
