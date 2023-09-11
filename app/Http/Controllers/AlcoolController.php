<?php

namespace App\Http\Controllers;

use App\Models\Alcool;
use App\Models\AlcoolCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\AlcoolStoreRequest;
use App\Http\Requests\AlcoolUpdateRequest;

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
        $categories = AlcoolCategory::all()->sortBy('name');

        return view('ingredients.index', compact('ingredients','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = AlcoolCategory::all()->sortBy('name');
        return view('ingredients.create.alcool_create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(AlcoolStoreRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($request->input('name'));   
        $data['slug'] = $slug;

        $name = ucwords($request->input('name'));
        $data['name'] = $name;
        

        if ($request->hasFile('image')) {
            $img_path = $request->file('image')->store('alcoool_img');
            $data['image'] = $img_path;
        }
    
        $alcool = Alcool::create($data);
    
            return redirect()->route('ingredients.alcools.show', ['category' => $alcool->category->name, 'slug' => $alcool->slug])
        ->with('success', 'Alcolico creato con successo');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug)
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
    public function edit($category, $slug)
    {

        $alcool = Alcool::where('slug', $slug)->first();
        $categories = AlcoolCategory::all()->sortBy('name');
        if (!$alcool) {
            abort(404); // Puoi personalizzare la pagina di errore 404 a tuo piacimento
        }

        return view('ingredients.edit.alcool_edit', compact('alcool','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function update(AlcoolUpdateRequest $request, Alcool $alcools)
    {
        $data = $request->validated();
    
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $alcools->name) {
            // Aggiorna lo slug se il nome è cambiato
            $slug = Str::slug($request->input('name'));
            $data['slug'] = $slug;
        }
    
        // Verifica se è stata caricata una nuova immagine
        if ($request->hasFile('image')) {
            // Elimina la vecchia immagine se esiste
            if ($alcools->image) {
                Storage::delete($alcools->image);
            }
    
            // Carica la nuova immagine e ottieni il percorso
            $img_path = $request->file('image')->store('alcoool_img');
            $data['image'] = $img_path;
        }
    
        // Aggiorna i dati dell'alcolico
        $alcools->update($data);
    
        return redirect()->route('ingredients.alcools.show', ['category' => $alcools->category->name, 'slug' => $alcools->slug])
            ->with('success', 'Alcolico aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alcool $alcools)
    {
        // Elimina l'immagine associata se esiste
        if ($alcools->image) {
            Storage::delete($alcools->image);
        }
    
        // Elimina l'alcolico dal database
        $alcools->delete();
    
        return redirect()->route('ingredients.alcools.index')
            ->with('success', 'Alcolico eliminato con successo');
    }
}
