<?php

namespace App\Models\Doctors_Panel;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceStatus extends Model
{
    use HasFactory;
    protected $table='invoice_status';
    protected  $fillable=['name'];
    public $translatedAttributes = ['name'];
    public function translations()
    {
        return $this->hasMany(InvoiceStatusTranslation::class);
    }
    public function translation()
    {
        return $this->hasOne(InvoiceStatusTranslation::class, 'invoice_status_id')
                    ->where('locale', app()->getLocale());
    }
}
