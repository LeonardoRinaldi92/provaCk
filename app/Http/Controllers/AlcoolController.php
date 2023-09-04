<?php

namespace App\Http\Controllers;

use App\Models\Alcool;
use Illuminate\Http\Request;

class AlcoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Alcool::all()->sortBy('name');

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
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ingredient = Alcool::where('slug', $slug)->first();
    
        if (!$ingredient) {
            abort(404); // Puoi personalizzare la pagina di errore 404 a tuo piacimento
        }

        return view('ingredients.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function edit(Alcool $alcool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alcool $alcool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alcool $alcool)
    {
        //
    }
}
