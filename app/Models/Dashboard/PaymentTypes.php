<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTypes extends Model
{
    use HasFactory;
    public function invoices(){
        return $this->hasMany(SingleInvoice::class,'payment_type_id');
    }
}
