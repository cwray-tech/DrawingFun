<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invitee extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function drawing(){
        return $this->belongsTo(Drawing::class);
    }


    public function receiver() {
        return $this->hasOne(Invitee::class, 'id', 'receiver_id');
    }

    public function giver(){
        return $this->belongsTo(Invitee::class, 'receiver_id');
    }
}
