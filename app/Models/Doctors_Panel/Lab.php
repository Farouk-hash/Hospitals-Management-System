<?php

namespace App\Models\Doctors_Panel;

use App\Models\Dashboard\SingleInvoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $table = 'lab';
    protected  $fillable  = ['notes','invoice_id'];
    public function invoice(){
        return $this->belongsTo(SingleInvoice::class , 'invoice_id');
    }
}
