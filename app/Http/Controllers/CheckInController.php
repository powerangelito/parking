<?php

namespace App\Http\Controllers;

use App\Models\checkIn;
use Illuminate\Http\Request;

class CheckInController extends Controller
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
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\checkIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function show(checkIn $checkIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\checkIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function edit(checkIn $checkIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\checkIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, checkIn $checkIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\checkIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(checkIn $checkIn)
    {
        //
    }
}
