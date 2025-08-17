<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('single-invoice-{doctor_id}', function ($user, $doctor_id) {
    return (int) $user->id === (int) $doctor_id;
},    
['guards' => ['doctor']]
);

Broadcast::channel('chat.{userType}.{userId}', function ($user, $userType, $userId) {
    
    $currentUserType = class_basename(get_class($user));
    \Log::info('Broadcast auth attempt', [
        'user' => $user ? $user->id : null,
        'user_type' => $user ? class_basename(get_class($user)) : null,
        'channel_user_type' => $userType,
        'channel_user_id' => $userId,
        'result'=>$currentUserType === $userType && $user->id == $userId
    ]);
    return $currentUserType === $userType && $user->id == $userId;
 },['guards' => ['doctor','ray_employee']]);
