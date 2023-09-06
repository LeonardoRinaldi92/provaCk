<?php

namespace App\Http\Controllers;

use App\Models\Glass;
use Illuminate\Http\Request;

class GlassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Glass::all()->sortBy('name');

        return view('items.index', compact('items'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Glass  $glass
     * @return \Illuminate\Http\Response
     */
    public function show(Glass $glass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Glass  $glass
     * @return \Illuminate\Http\Response
     */
    public function edit(Glass $glass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Glass  $glass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Glass $glass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Glass  $glass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Glass $glass)
    {
        //
    }
}
