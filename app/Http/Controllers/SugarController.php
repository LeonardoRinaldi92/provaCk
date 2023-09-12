<?php

namespace App\Http\Controllers;

use App\Models\Sugar;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Http\Requests\SugarStoreRequest;
use App\Http\Requests\SugarUpdateRequest;

class SugarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Sugar::all()->sortBy('name');

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create.sugar_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SugarStoreRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($request->input('name'));   
        $data['slug'] = $slug;

        $name = ucwords($request->input('name'));
        $data['name'] = $name;

        $sugar = Sugar::create($data);

        return redirect()->route('ingredients.sugars.show', ['slug' => $sugar->slug])
        ->with('success', 'Zucchero creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sugar  $sugar
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ingredient = Sugar::where('slug', $slug)->first();
    
        if (!$ingredient) {
            abort(404); // Puoi personalizzare la pagina di errore 404 a tuo piacimento
        }

        return view('ingredients.show', compact('ingredient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sugar  $sugar
     * @return \Illuminate\Http\Response
     */
    public function edit( $slug)
    {
        $sugar = Sugar::where('slug', $slug)->first();
        return view('ingredients.edit.sugar_edit', compact('sugar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sugar  $sugar
     * @return \Illuminate\Http\Response
     */
    public function update(SugarUpdateRequest $request, Sugar $sugars)
    {
        $data = $request->validated();
    
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $sugars->name) {
            // Aggiorna lo slug se il nome è cambiato
            $slug = Str::slug($request->input('name'));
            $data['slug'] = $slug;

            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
        
        $sugars->update($data);

        return redirect()->route('ingredients.sugars.show', ['slug' => $sugars->slug])
        ->with('success', 'Zucchero modificato con successo');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sugar  $sugar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sugar $sugars)
    {
        $sugars->delete();
    
        return redirect()->route('ingredients.sugars.index')
            ->with('success', 'Alcolico eliminato con successo');
    }
}
