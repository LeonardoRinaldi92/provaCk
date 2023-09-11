<?php

namespace App\Http\Controllers;

use App\Models\AromaticBitter;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\AromaticBitterStoreRequest;
use App\Http\Requests\AromaticBitterUpdateRequest;


class AromaticBitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = AromaticBitter::all()->sortBy('name');

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create.aromaticBitter_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AromaticBitterStoreRequest $request)
    {
        
        $data = $request->validated();

        $slug = Str::slug($request->input('name'));   
        $data['slug'] = $slug;

        $name = ucwords($request->input('name'));
        $data['name'] = $name;
        

        if ($request->hasFile('image')) {
            $img_path = $request->file('image')->store('aromatic_bitters_img');
            $data['image'] = $img_path;
        }
    
        $bitter = AromaticBitter::create($data);
    
            return redirect()->route('ingredients.aromatic_bitters.show', ['slug' => $bitter->slug])
        ->with('success', 'Alcolico creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bitter  $bitter
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ingredient = AromaticBitter::where('slug', $slug)->first();
    
        if (!$ingredient) {
            abort(404); // Puoi personalizzare la pagina di errore 404 a tuo piacimento
        }

        return view('ingredients.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bitter  $bitter
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $bitter = AromaticBitter::where('slug', $slug)->first();
        return view('ingredients.edit.aromaticBitter_edit', compact('bitter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bitter  $bitter
     * @return \Illuminate\Http\Response
     */
    public function update(AromaticBitterUpdateRequest $request, AromaticBitter $aromatic_bitters)
    {
        $data = $request->validated();
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $aromatic_bitters->name) {
            // Aggiorna lo slug se il nome è cambiato
            $slug = Str::slug($request->input('name'));
            $data['slug'] = $slug;
        }
    
        // Verifica se è stata caricata una nuova immagine
        if ($request->hasFile('image')) {
            // Elimina la vecchia immagine se esiste
            if ($aromatic_bitters->image) {
                Storage::delete($aromatic_bitters->image);
            }
    
            // Carica la nuova immagine e ottieni il percorso
            $img_path = $request->file('image')->store('aromatic_bitters_img');
            $data['image'] = $img_path;
        }
    
        // Aggiorna i dati dell'alcolico
        $aromatic_bitters->update($data);
    
        return redirect()->route('ingredients.aromatic_bitters.show', ['slug' => $aromatic_bitters->slug])
            ->with('success', 'Alcolico aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bitter  $bitter
     * @return \Illuminate\Http\Response
     */
    public function destroy(AromaticBitter $bitter)
    {
        //
    }
}
