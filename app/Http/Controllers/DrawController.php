<?php

namespace App\Http\Controllers;

use App\Models\Drawing;
use App\Models\Invitee;
use App\Notifications\YouveDrawnAName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class DrawController extends Controller
{
    public function show(Drawing $drawing, Invitee $invitee)
    {
        $receiver = $invitee->receiver;
        return inertia('Draw/Show', compact('drawing', 'invitee'));
    }

    public function store(Request $request, Drawing $drawing, Invitee $invitee)
    {

        $receiver = $invitee->available()->count() > 0
            ? $invitee->available()->inRandomOrder()->first()
            : $invitee;

        //if there are no available invitees, and the invitee already has a receiver, then do nothing.
        if($invitee->available()->count() == 0 && $invitee->receiver) 
        { 
            return back()->banner("Sorry, there are no more available names to draw."); 
        }
        else {
            $invitee->receiver()->associate($receiver);
            $invitee->save();
        }

        Notification::send($invitee, new YouveDrawnAName($invitee->receiver, $drawing));

        return back()->banner('Yay!! You drew a name! Congrats.');
    }
}
