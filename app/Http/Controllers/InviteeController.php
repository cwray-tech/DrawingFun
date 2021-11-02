<?php

namespace App\Http\Controllers;

use App\Models\Drawing;
use App\Models\Invitee;
use Illuminate\Http\Request;

class InviteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Drawing $drawing)
    {
        $drawing->invitees()->create($request->all());
        return back()->banner('Invitee added');
    }

    public function invite(Request $request, Drawing $drawing)
    {
        $drawing->inviteGuests();
        return back()->banner('Invites have been sent out! Great work.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invitee  $invitee
     * @return \Illuminate\Http\Response
     */
    public function show(Invitee $invitee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invitee  $invitee
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitee $invitee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invitee  $invitee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invitee $invitee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invitee  $invitee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitee $invitee)
    {
        //
    }
}
