<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecieptAccount extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id','debit','notes'];
    protected $table = 'reciept_account';
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
    
}
