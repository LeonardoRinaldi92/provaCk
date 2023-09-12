<?php

namespace App\Http\Controllers;

use App\Models\Other;
use Illuminate\Http\Request;

use App\Http\Requests\OtherStoreRequest;
use App\Http\Requests\OtherUpdateRequest;

class OtherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Other::all()->sortBy('name');

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create.other_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OtherStoreRequest $request)
    {
        $data = $request->validated();
        

        $name = ucwords($request->input('name'));
        $data['name'] = $name;

        Other::create($data);

        return redirect()->route('ingredients.others.index')
        ->with('success', 'Altro creato con successo');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Other  $other
     * @return \Illuminate\Http\Response
     */
    public function edit(Other $others)
    {
        $other = $others;
        return view('ingredients.edit.other_edit', compact('other'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Other  $other
     * @return \Illuminate\Http\Response
     */
    public function update(OtherUpdateRequest $request, Other $others)
    {
        $data = $request->validated();

    
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $others->name) {
            // Aggiorna lo slug se il nome è cambiato
            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
        
        $others->update($data);

        return redirect()->route('ingredients.others.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Other  $other
     * @return \Illuminate\Http\Response
     */
    public function destroy(Other $others)
    {
        $others->delete();
    
        return redirect()->route('ingredients.others.index')
            ->with('success', 'Altro eliminato eliminato con successo');
    }
}
