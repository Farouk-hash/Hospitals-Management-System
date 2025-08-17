<?php

namespace App\Models\Chat;

use App\Traits\HasOtherParty;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use HasOtherParty;
    protected $table = 'message';
    protected $fillable=['converstaion_id' , 'body' , 'sender_id' , 'sender_type' , 'receiver_id' , 'receiver_type','created_at'];
    public function conversation(){
        return $this->belongsTo(Conversation::class , 'converstaion_id' , 'id');
    }

    public function isMine(){
        return Auth::id()==$this->sender_id && get_class(auth()->user())==$this->sender_type;
    }   
}
