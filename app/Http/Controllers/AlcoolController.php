<?php

namespace App\Http\Controllers;

use App\Models\Alcool;
use App\Models\AlcoolCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\AlcoolStoreRequest;

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

        if ($request->hasFile('image')) {
            $img_path = $request->file('image')->store('alcoool_img');
            $data['image'] = $img_path;
        }
    
        Alcool::create($data);
    
        return redirect()->route('ingredients.index')->with('success', 'Alcolico creato con successo');
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
    public function edit(Alcool $alcool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alcool $alcool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alcool  $alcool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alcool $alcool)
    {
        //
    }
}
