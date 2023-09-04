<?php

namespace App\Http\Controllers;

use App\Models\Juice;
use Illuminate\Http\Request;

class JuiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Juice::all();

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
     * @param  \App\Models\Juice  $juice
     * @return \Illuminate\Http\Response
     */
    public function show(Juice $juice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Juice  $juice
     * @return \Illuminate\Http\Response
     */
    public function edit(Juice $juice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Juice  $juice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Juice $juice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Juice  $juice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Juice $juice)
    {
        //
    }
}
