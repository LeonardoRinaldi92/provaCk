<?php

namespace App\Http\Controllers;

use App\Models\Glass;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\GlassStoreRequest;
use App\Http\Requests\GlassUpdateRequest;

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
        return view('items.create.glass_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GlassStoreRequest $request)
    {
        
        $data = $request->validated();

        $slug = Str::slug($request->input('name'));   
        $data['slug'] = $slug;

        $name = ucwords($request->input('name'));
        $data['name'] = $name;
        

        if ($request->hasFile('image')) {
            $img_path = $request->file('image')->store('glass_img');
            $data['image'] = $img_path;
        }
    
        $glass = Glass::create($data);
    
            return redirect()->route('items.glasses.show', ['slug' => $glass->slug])
        ->with('success', 'Alcolico creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Glass  $glass
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = Glass::where('slug', $slug)->first();
    
        if (!$item) {
            abort(404); // Puoi personalizzare la pagina di errore 404 a tuo piacimento
        }

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Glass  $glass
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $glass = Glass::where('slug', $slug)->first();
        return view('items.edit.glass_edit', compact('glass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Glass  $glass
     * @return \Illuminate\Http\Response
     */
    public function update(GlassUpdateRequest $request, Glass $glasses)
    {
        $data = $request->validated();
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $glasses->name) {
            // Aggiorna lo slug se il nome è cambiato
            $slug = Str::slug($request->input('name'));
            $data['slug'] = $slug;

            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
    
        // Verifica se è stata caricata una nuova immagine
        if ($request->hasFile('image')) {
            // Elimina la vecchia immagine se esiste
            if ($glasses->image) {
                Storage::delete($glasses->image);
            }
    
            // Carica la nuova immagine e ottieni il percorso
            $img_path = $request->file('image')->store('glass_img');
            $data['image'] = $img_path;
        }
    
        // Aggiorna i dati dell'alcolico
        $glasses->update($data);
    
        return redirect()->route('items.glasses.show', ['slug' => $glasses->slug])
            ->with('success', 'Alcolico aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Glass  $glass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Glass $glasses)
    {
        if ($glasses->image) {
            Storage::delete($glasses->image);
        }

        $glasses->delete();

        return redirect()->route('items.glasses.index')
        ->with('success', 'bitter eliminato con successo');
    }
}
