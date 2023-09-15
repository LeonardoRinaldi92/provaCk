<?php

namespace App\Http\Controllers;

use App\Models\Ice;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\IceStoreRequest;
use App\Http\Requests\GlassUpdateRequest;
use App\Http\Requests\IceUpdateRequest;

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
        return view('items.create.ice_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IceStoreRequest $request)
    {
        
        $data = $request->validated();

        $slug = Str::slug($request->input('name'));   
        $data['slug'] = $slug;

        $name = ucwords($request->input('name'));
        $data['name'] = $name;
        

        if ($request->hasFile('image')) {
            $img_path = $request->file('image')->store('ice_img');
            $data['image'] = $img_path;
        }
    
        $ice = Ice::create($data);
    
            return redirect()->route('items.ices.show', ['slug' => $ice->slug])
        ->with('success', 'Alcolico creato con successo');
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
    public function edit($slug)
    {
        $ice = Ice::where('slug', $slug)->first();
        return view('items.edit.ice_edit', compact('ice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ice  $ice
     * @return \Illuminate\Http\Response
     */
    public function update(IceUpdateRequest $request, Ice $ices)
    {
        $data = $request->validated();
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $ices->name) {
            // Aggiorna lo slug se il nome è cambiato
            $slug = Str::slug($request->input('name'));
            $data['slug'] = $slug;

            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
    
        // Verifica se è stata caricata una nuova immagine
        if ($request->hasFile('image')) {
            // Elimina la vecchia immagine se esiste
            if ($ices->image) {
                Storage::delete($ices->image);
            }
    
            // Carica la nuova immagine e ottieni il percorso
            $img_path = $request->file('image')->store('ice_img');
            $data['image'] = $img_path;
        }
    
        // Aggiorna i dati dell'alcolico
        $ices->update($data);
    
        return redirect()->route('items.ices.show', ['slug' => $ices->slug])
            ->with('success', 'Alcolico aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ice  $ice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ice $ices)
    {
        if ($ices->image) {
            Storage::delete($ices->image);
        }

        $ices->delete();

        return redirect()->route('items.ices.index')
        ->with('success', 'bitter eliminato con successo');
    }
}
