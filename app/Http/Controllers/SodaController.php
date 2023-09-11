<?php

namespace App\Http\Controllers;

use App\Models\Soda;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Http\Requests\SodaStoreRequest;
use App\Http\Requests\SodaUpdateRequest;

class SodaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Soda::all()->sortBy('name');

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create.soda_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SodaStoreRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($request->input('name'));   
        $data['slug'] = $slug;

        $name = ucwords($request->input('name'));
        $data['name'] = $name;

        $soda = Soda::create($data);

        return redirect()->route('ingredients.sodas.show', ['slug' => $soda->slug])
        ->with('success', 'Soda creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soda  $soda
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ingredient = Soda::where('slug', $slug)->first();
    
        if (!$ingredient) {
            abort(404); // Puoi personalizzare la pagina di errore 404 a tuo piacimento
        }

        return view('ingredients.show', compact('ingredient'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Soda  $soda
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $soda = Soda::where('slug', $slug)->first();
        return view('ingredients.edit.soda_edit', compact('soda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soda  $soda
     * @return \Illuminate\Http\Response
     */
    public function update(SodaUpdateRequest $request, Soda $sodas)
    {
        $data = $request->validated();
    
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $sodas->name) {
            // Aggiorna lo slug se il nome è cambiato
            $slug = Str::slug($request->input('name'));
            $data['slug'] = $slug;

            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
        
        $sodas->update($data);

        return redirect()->route('ingredients.sodas.show', ['slug' => $sodas->slug])
        ->with('success', 'Soda modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soda  $soda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soda $sodas)
    {
        $sodas->delete();
    
        return redirect()->route('ingredients.sodas.index')
            ->with('success', 'Alcolico eliminato con successo');
    }
}
