<?php

namespace App\Traits;

use Auth;
use Carbon\Carbon;

trait HasOtherParty{
    
     
    public function getCreatedAtHumanAttribute(){
        return Carbon::parse($this->attributes['created_at'])->shortAbsoluteDiffForHumans();
    }

    public function sender(){
        return $this->morphTo(__FUNCTION__ , 'sender_type', 'sender_id');
    }

    public function receiver(){
        return $this->morphTo(__FUNCTION__ , 'receiver_type' , 'receiver_id');
    }

    public function getOtherPartyAttribute(){
        return ($this->sender_id == Auth::id() && $this->sender_type == get_class(Auth::user())) ? 
        $this->receiver : $this->sender;
    }
    
    public function getOtherPartyImageUrlAttribute(){
        $otherPartyClass = get_class($this->otherParty);
        return $this->imagesFolders(class:$otherPartyClass , sender:0) ;

    }

     public function getSenderImageUrlAttribute(){
        $senderClass = get_class($this->sender);
        return $this->imagesFolders($senderClass , 1) ;
    }
    protected function imagesFolders($class , $sender){
        $folders = [
            'App\Models\Dashboard\xRayEmployee' => 'xRayEmployee',
            'App\Models\Dashboard\Doctor'       => 'Doctors',
            'App\Models\Admin'                  => 'Admins',
        ];

        $folder = $folders[$class];

        $image = $sender ? $this->sender->image : $this->otherParty->image ; 
        return $image ? "{$folder}/{$image->url}" : "{$folder}/default.png";
    }
}