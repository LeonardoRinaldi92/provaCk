<?php

namespace App\Http\Controllers;

use App\Models\AromaticBitter;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\AromaticBitterStoreRequest;


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
            $img_path = $request->file('image')->store('alcoool_img');
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
    public function update(Request $request, AromaticBitter $bitter)
    {
        //
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
