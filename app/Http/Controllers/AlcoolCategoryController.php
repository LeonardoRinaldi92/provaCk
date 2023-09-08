<?php

namespace App\Http\Controllers;

use App\Models\AlcoolCategory;
use App\Models\Alcool;
use Illuminate\Http\Request;
use App\Http\Requests\AlcoolCategoryRequest;
use App\Http\Requests\AlcoolCategoryUpdateRequest;



class AlcoolCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
        // Trova la categoria di alcool
        $alcoolCategory = AlcoolCategory::where('name', $category)->first();
    
        if (!$alcoolCategory) {
            // Categoria non trovata, gestisci l'errore o reindirizza
            return redirect()->route('ingredients.index')->with('error', 'Categoria non trovata');
        }
    
        // Ottieni gli ingredienti associati alla categoria di alcool
        $ingredients = Alcool::where('alcool_categories_id', $alcoolCategory->id)->get();
    
        $categories = AlcoolCategory::all()->sortBy('name');
    
        return view('ingredients.index', compact('ingredients', 'categories'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rotta = 'ingredients.alcoolscategory';
        $pagina = 'Categoria Alcoolici';
        $alcoolCategories = AlcoolCategory::pluck('name');
        return view('ingredients.create.alcoolCategory', compact('rotta','pagina','alcoolCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlcoolCategoryRequest $request)
    {
        $data = $request->validated();
        $data['name'] = ucfirst($data['name']); // Capitalize the first letter
    
        AlcoolCategory::create($data);
    
        return redirect()->route('ingredients.index')->with('success', 'Categoria di alcool creata con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlcoolCategory  $alcoolCategory
     * @return \Illuminate\Http\Response
     */
    public function show(AlcoolCategory $alcoolCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlcoolCategory  $alcoolCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(AlcoolCategory $categoryName)
    {
        $rotta = 'ingredients.alcoolscategory';
        $pagina = 'Categoria Alcoolici';
        return view('ingredients.edit.alcoolCategory', compact('rotta', 'pagina','categoryName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlcoolCategory  $alcoolCategory
     * @return \Illuminate\Http\Response
     */
    public function update(AlcoolCategoryUpdateRequest $request, AlcoolCategory $categoryName)
    {
        $form_data = $request->validated();

        $categoryName->update($form_data);

    
        return redirect()->route('ingredients.index')->with('success', 'Categoria di alcool aggiornata con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlcoolCategory  $alcoolCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlcoolCategory $categoryName)
    {
        Alcool::where('alcool_categories_id', $categoryName->id)->delete();
        $categoryName->delete();

        return redirect()->route('ingredients.index')->with('success', 'Categoria di alcool eliminata con successo');
    }
}
