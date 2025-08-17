<?php

namespace App\Models\Chat;

use App\Traits\HasOtherParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;
    use HasOtherParty ;
    protected $table = 'converstaion';
    protected $fillable=['sender_id' , 'sender_type','receiver_id' , 'receiver_type','last_seen_message'];
    
    public function scopeConversationsBetweenParties($query){
        return $query->with(['sender','receiver'])->where(function($query){
            $query->where('sender_id' , Auth::id())
            // ->where('sender_type' , get_class(auth()->user()));
            ->where('sender_type', Auth::guard()->getProvider()->getModel());

        })
        ->orWhere(function ($query){
            $query->where('receiver_id' , Auth::id())
            // ->where('receiver_type' , get_class(auth()->user()));
            ->where('receiver_type' ,  Auth::guard()->getProvider()->getModel());

        })
        ->orderByDesc('id');
    }

    public function scopeCountConversation($query , $sender_id , $sender_type , $receiver_id , $receiver_type){
        return 
        $query
        ->where(function($query)use($sender_id , $sender_type){
            $query->where('sender_id', $sender_id)
            ->where('sender_type' , $sender_type)
            ->orWhere('receiver_id',$sender_id)->
            where('receiver_type' , $sender_type);
        })
        ->where(function($query) use($receiver_id , $receiver_type){
            $query->where('sender_id', $receiver_id)
            ->where('sender_type' , $receiver_type)
            ->orWhere('receiver_id',$receiver_id)->
            where('receiver_type' , $receiver_type);
        }) ;
    }
    
    public function getLastSeenMessageAttribute($value){
        return \Carbon\Carbon::parse($value)->shortAbsoluteDiffForHumans();
    }

    public function messages(){
        return $this->hasMany(Message::class , 'converstaion_id');
    }

    public function getMessagesCountAttribute(){
        return $this->messages()->count();
    }
    public function getUnReadMessagesCountAttribute(){
        return $this->messages()->where('read',false)->count();
    }
    public function lastMessage(){
        return $this->messages()->orderByDesc('id')->first();
    }
}
