<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notifications extends Model
{
    use HasFactory;
    protected $table = 'notifications';

    protected $fillable = ['message' , 'reader_status' , 'user_name' , 'user_id' , 'user_type' , 'route_name' , 'route_params' , 'email'];

    protected $casts = [
        'route_params' => 'array',
        'reader_status' => 'boolean',
    ];

    protected function resolveModelClass($related_model)
    {
        $map = [
            'doctor' => '\App\Models\Dashboard\Doctor',
            'patient' => '\App\Models\Dashboard\Patient',
            'admin'   => '\App\Models\Admin'
        ];

        return $map[$related_model];
    }

    public function scopeUnread($query , $model)
    {   
        $model = $this->resolveModelClass($model) ;
        return $query->where('user_id' , Auth::id())->where('reader_status', false)->where('user_type' , $model);
    }

    public function scopeRead($query, $model)
    {
        $model = $this->resolveModelClass($model) ;
        return $query->where('user_id' , Auth::id())->where('reader_status', true)->where('user_type' , $model);
    }


    public function getRedirectUrl()
    {
        try {
            return route($this->route_name, $this->route_params ?? []);
        } catch (\Exception $e) {
            // Fallback if route or params are invalid
            return url('/');
        }
    }

}
