<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupServicesTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name','notes'];

    public $timestamps = false;
    public function groupServices(){
        return $this->belongsTo(groupServices::class);
    }
}
