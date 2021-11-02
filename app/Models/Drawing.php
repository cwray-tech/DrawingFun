<?php

namespace App\Models;

use App\Notifications\InvitedToDrawing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Drawing extends Model
{
    use HasFactory;
    protected $gaurded = [];
    protected $fillable = ['name', 'description', 'user_id'];
    protected $with = ['invitees', 'availableInvitees'];
    
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function invitees()
    {
        return $this->hasMany(Invitee::class);
    }

    public function availableInvitees()
    {
        return $this->invitees()->doesnthave('giver');
    }

    public function inviteGuests()
    {
        Notification::send($this->invitees, new InvitedToDrawing($this));
    }

}
