<?php

namespace App\Http\Controllers;

use App\Models\Ice;
use Illuminate\Http\Request;

class IceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Ice::all()->sortBy('name');

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
     * @param  \App\Models\Ice  $ice
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = Ice::where('slug', $slug)->first();
    
        if (!$item) {
            abort(404); // Puoi personalizzare la pagina di errore 404 a tuo piacimento
        }

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ice  $ice
     * @return \Illuminate\Http\Response
     */
    public function edit(Ice $ice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ice  $ice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ice $ice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ice  $ice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ice $ice)
    {
        //
    }
}
