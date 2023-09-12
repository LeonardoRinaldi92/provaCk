<?php

namespace App\Http\Controllers;

use App\Models\Syrup;
use Illuminate\Http\Request;

use App\Http\Requests\SyrupStoreRequest;
use App\Http\Requests\SyrupUpdateRequest;

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
        return view('ingredients.create.syrup_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        

        $name = ucwords($request->input('name'));
        $data['name'] = $name;

        Syrup::create($data);

        return redirect()->route('ingredients.syrups.index')
        ->with('success', 'Altro creato con successo');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Syrup  $syrup
     * @return \Illuminate\Http\Response
     */
    public function edit(Syrup $syrups)
    {
        $syrup = $syrups;
        return view('ingredients.edit.syrup_edit', compact('syrup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Syrup  $syrup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Syrup $syrups)
    {
        $data = $request->validated();

    
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $syrups->name) {
            // Aggiorna lo slug se il nome è cambiato
            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
        
        $syrups->update($data);

        return redirect()->route('ingredients.syrups.index');
    
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Syrup  $syrup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Syrup $syrups)
    {
        $syrups->delete();
    
        return redirect()->route('ingredients.syrups.index')
            ->with('success', 'Altro eliminato eliminato con successo');
    }
}
