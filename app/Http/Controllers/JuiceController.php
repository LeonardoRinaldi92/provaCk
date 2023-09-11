<?php

namespace App\Http\Controllers;

use App\Models\Juice;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Http\Requests\JuiceStoreRequest;
use App\Http\Requests\JuiceUpdateRequest;


class JuiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Juice::all()->sortBy('name');

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create.juice_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JuiceStoreRequest $request)
    {
        $data = $request->validated();
        

        $name = ucwords($request->input('name'));
        $data['name'] = $name;

        Juice::create($data);

        return redirect()->route('ingredients.juices.index')
        ->with('success', 'Succo creato con successo');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Juice  $juice
     * @return \Illuminate\Http\Response
     */
    public function edit(Juice $juices)
    {
        $juice = $juices;
        return view('ingredients.edit.juice_edite', compact('juice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Juice  $juice
     * @return \Illuminate\Http\Response
     */
    public function update(JuiceUpdateRequest $request, Juice $juices)
    {
        $data = $request->validated();

    
        // Verifica se il nome è stato modificato
        if ($request->has('name') && $request->input('name') !== $juices->name) {
            // Aggiorna lo slug se il nome è cambiato
            $name = ucwords($request->input('name'));
            $data['name'] = $name;
        }
        
        $juices->update($data);

        return redirect()->route('ingredients.juices.index');
    
    }
      

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Juice  $juice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Juice $juices)
    {
        $juices->delete();
    
        return redirect()->route('ingredients.juices.index')
            ->with('success', 'Succo eliminato eliminato con successo');
    }
}
