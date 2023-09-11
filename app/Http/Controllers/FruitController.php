<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;

use App\Http\Requests\FruitStoreRequest;
use App\Http\Requests\FruitUpdateRequest;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Fruit::all()->sortBy('name');

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create.fruit_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FruitStoreRequest $request)
    {
        $data = $request->validated();
        

        $name = ucwords($request->input('name'));
        $data['name'] = $name;

        Fruit::create($data);

        return redirect()->route('ingredients.fruits.index')
        ->with('success', 'Succo creato con successo');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fruit  $fruit
     * @return \Illuminate\Http\Response
     */
    public function edit(Fruit $fruits)
    {
        $fruit = $fruits;
        return view('ingredients.edit.fruit_edit', compact('fruit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fruit  $fruit
     * @return \Illuminate\Http\Response
     */
    public function update(FruitUpdateRequest $request, Fruit $fruits)
    {
        $data = $request->validated();

    
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $fruits->name) {
            // Aggiorna lo slug se il nome è cambiato
            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
        
        $fruits->update($data);

        return redirect()->route('ingredients.fruits.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fruit  $fruit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fruit $fruits)
    {
        $fruits->delete();
    
        return redirect()->route('ingredients.fruits.index')
            ->with('success', 'Succo eliminato eliminato con successo');
    }
}
