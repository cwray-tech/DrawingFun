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
        $invitee->update([
            'receiver_id'=> $request->giving_to
        ]);

        Notification::send($invitee, new YouveDrawnAName($invitee->receiver, $drawing));

        return back()->banner('Yay!! You drew a name! Congrats.');
    }
}
