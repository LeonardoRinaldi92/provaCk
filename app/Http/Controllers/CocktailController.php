<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

use App\Models\Cocktail;
use App\Models\Alcool;
use App\Models\AromaticBitter;
use App\Models\Soda;
use App\Models\Juice;
use App\Models\Syrup;
use App\Models\Sugar;
use App\Models\Fruit;
use App\Models\Other;
use App\Models\Equipement;
use App\Models\Ice;
use App\Models\Glass;

use Illuminate\Http\Request;

class CocktailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Recupera tutti i cocktail con le relazioni utilizzando eager loading
        $cocktails = Cocktail::with(['glass', 'ice', 'equipments', 'ingredients'])->get();
    
        // Restituisci la vista con i dati
        return view('cocktails.index', compact('cocktails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        function getModelData($model) {
            $data = $model::all()->sortBy('name');
            foreach ($data as $item) {
                $item['model'] = $item->getMorphClass();
            }
            return json_encode($data);
        }
        
        $alcools = getModelData(Alcool::class);
        $aromaticBitters = getModelData(AromaticBitter::class);
        $fruits = getModelData(Fruit::class);
        $juices = getModelData(Juice::class);
        $others = getModelData(Other::class);
        $sodas = getModelData(Soda::class);
        $sugars = getModelData(Sugar::class);
        $syrups = getModelData(Syrup::class);
        

        $cocktails = Cocktail::all()->sortBy('name'); 



        $equipements = Equipement::all()->sortBy('name');
        $ices = Ice::all()->sortBy('name');
        $glasses = Glass::all()->sortBy('name');

        return view('cocktails.create.cocktail_create', compact('alcools',
            'aromaticBitters',
            'fruits',
            'juices',
            'others',
            'sodas',
            'sugars',
            'syrups', 'equipements', 'ices', 'glasses', 'cocktails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cocktail  $cocktail
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Recupera il cocktail basato sullo slug
        $cocktail = Cocktail::with(['glass', 'ice', 'equipments', 'ingredients'])
            ->where('slug', $slug)
            ->firstOrFail();
    
        // Restituisci la vista "show" con il cocktail
        return view('cocktails.show', compact('cocktail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cocktail  $cocktail
     * @return \Illuminate\Http\Response
     */
    public function edit(Cocktail $cocktail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cocktail  $cocktail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cocktail $cocktail)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cocktail  $cocktail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cocktail $cocktail)
    {
        //
    }
}
