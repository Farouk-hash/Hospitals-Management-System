<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'services_translations';

    public $timestamps = false;
    public function services(){
        return $this->belongsTo(Services::class);
    }
}
