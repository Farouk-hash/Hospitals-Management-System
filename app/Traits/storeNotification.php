<?php 
namespace App\Traits;

use App\Models\Events\Notifications;
trait StoreNotification{
    public function storeNotification($notification_data){
        Notifications::create([
            'message' => $notification_data['message'],

            'user_id' => $notification_data['user_id'],
            'user_type'=>$notification_data['user_type'],
            'user_name'=>$notification_data['user_name'],
            
            'route_name' => $this->getRoute($notification_data['route_type']),
            'route_params' => $notification_data['route_params'],
            'email'=>$notification_data['email']
        ]);
    }
    protected function getRoute($type){
        $values = ['patient_show'=>'dashboard.patient.show'];
        return $values[$type];
    }
}