<?php

namespace App\Http\Controllers;

use App\Models\Drawing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DrawingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia('Drawings/Index', [
            'drawings' => auth()->user()->drawings,
        ]);
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
    public function store(Request $request)
    {
        $drawing = $request->user()->drawings()->create([
                'name' => $request->drawing_name,
            ]);
        return redirect()->route('drawings.show', $drawing->id)->banner('Woohoo! you\'ve created a new drawing!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drawing  $drawing
     * @return \Illuminate\Http\Response
     */
    public function show(Drawing $drawing)
    {
        $invitees = $drawing->invitees()->with('receiver')->get();
        return inertia('Drawings/Show', compact('drawing', 'invitees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drawing  $drawing
     * @return \Illuminate\Http\Response
     */
    public function edit(Drawing $drawing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drawing  $drawing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drawing $drawing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drawing  $drawing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drawing $drawing)
    {
        //
    }
}
