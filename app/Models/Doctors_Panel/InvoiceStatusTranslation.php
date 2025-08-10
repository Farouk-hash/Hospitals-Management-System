<?php

namespace App\Models\Doctors_Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceStatusTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='invoice_status_translations';
    protected $fillable = ['name'];
}
