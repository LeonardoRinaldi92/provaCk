<?php

namespace App\Http\Controllers;

use App\Models\Syrup;
use Illuminate\Http\Request;

class SyrupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Syrup::all()->sortBy('name');

        return view('ingredients.index', compact('ingredients'));
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
     * @param  \App\Models\Syrup  $syrup
     * @return \Illuminate\Http\Response
     */
    public function show(Syrup $syrup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Syrup  $syrup
     * @return \Illuminate\Http\Response
     */
    public function edit(Syrup $syrup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Syrup  $syrup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Syrup $syrup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Syrup  $syrup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Syrup $syrup)
    {
        //
    }
}
