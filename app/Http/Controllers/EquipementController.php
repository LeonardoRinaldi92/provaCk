<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\EquipementStoreRequest;
use App\Http\Requests\EquipementUpdateRequest;


class EquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Equipement::all()->sortBy('name');

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create.equipement_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipementStoreRequest $request)
    {
        
        $data = $request->validated();

        $slug = Str::slug($request->input('name'));   
        $data['slug'] = $slug;

        $name = ucwords($request->input('name'));
        $data['name'] = $name;
        

        if ($request->hasFile('image')) {
            $img_path = $request->file('image')->store('equipement_img');
            $data['image'] = $img_path;
        }
    
        $equipement = Equipement::create($data);
    
            return redirect()->route('items.equipements.show', ['slug' => $equipement->slug])
        ->with('success', 'Alcolico creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipement  $equipement
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = Equipement::where('slug', $slug)->first();
    
        if (!$item) {
            abort(404); // Puoi personalizzare la pagina di errore 404 a tuo piacimento
        }

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipement  $equipement
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $equipement = Equipement::where('slug', $slug)->first();
        return view('items.edit.equipement_edit', compact('equipement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipement  $equipement
     * @return \Illuminate\Http\Response
     */
    public function update(EquipementUpdateRequest $request, Equipement $equipements)
    {
        $data = $request->validated();
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $equipements->name) {
            // Aggiorna lo slug se il nome è cambiato
            $slug = Str::slug($request->input('name'));
            $data['slug'] = $slug;

            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
    
        // Verifica se è stata caricata una nuova immagine
        if ($request->hasFile('image')) {
            // Elimina la vecchia immagine se esiste
            if ($equipements->image) {
                Storage::delete($equipements->image);
            }
    
            // Carica la nuova immagine e ottieni il percorso
            $img_path = $request->file('image')->store('equipement_img');
            $data['image'] = $img_path;
        }
    
        // Aggiorna i dati dell'alcolico
        $equipements->update($data);
    
        return redirect()->route('items.equipements.show', ['slug' => $equipements->slug])
            ->with('success', 'Alcolico aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipement  $equipement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipement $equipements)
    {
        if ($equipements->image) {
            Storage::delete($equipements->image);
        }

        $equipements->delete();

        return redirect()->route('items.equipements.index')
        ->with('success', 'bitter eliminato con successo');
    }
}
