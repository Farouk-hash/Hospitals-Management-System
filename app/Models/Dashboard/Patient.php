<?php

namespace App\Models\Dashboard;

use Astrotomic\Translatable\Translatable;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    use Translatable ;
    
    protected $table = 'patient';
    public string $translationForeignKey = 'patient_id';
    public $fillable = ['email','password','phone_number','birth_date'];
    public $translatedAttributes = ['name','notes','gender_id'];
    /**
     * Automatically hash phone_number and assign to password.
     */
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = $value;

        // Hash phone_number and assign to password
        $this->attributes['password'] = Hash::make($value);
    }
    public function singleInvoices(){
        return $this->hasMany(SingleInvoice::class , 'patient_id');
    }
    // promissory-bond [سندات القبض]
    public function receieptAccount(){
        return $this->hasMany(RecieptAccount::class , 'patient_id');
    }
    // payment-account [سندات الصرف]
    public function paymentAccount(){
        return $this->hasMany(PaymentAccount::class , 'patient_id');
    }
}
