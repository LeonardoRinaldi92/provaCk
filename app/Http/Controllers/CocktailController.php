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

use App\Models\Ingredient;
use App\Models\CocktailEquipement;

use Illuminate\Http\Request;
use App\Http\Requests\CocktailStoreRequest;



use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
    public function store(CocktailStoreRequest $request)
{  
    

    $data = $request->validated();
    $data['official_ABV'] = $data['official_ABV'] ?? null;
    $data['ice_id'] = $data['ice_id'] ?? null;
    $data['variation'] = $data['variation'] ?? null;
    $data['signature_text'] = $data['signature_text'] ?? null;
    $data['garnish'] = $data['garnish'] ?? null;
    $data['straw'] = $data['straw'] ?? null;


    

    $cocktailData = [
        'description' => $data['description'],
        'preparation' => $data['preparation'],
        'avg_ABV' => $data['ABV'], // Cambia questo con il tuo valore reale
        'official_IBA' => boolval($data['official_ABV']),
        'glass_id' => $data['glass_id'], // Cambia questo con l'ID corretto del bicchiere
        'straw' => boolval($data['straw']),
        'slug' => 'negroni' // Assicurati che questo valore sia impostato correttamente
    ];

    $name = ucwords($data['name']);
    $cocktailData['name'] = $name;

    $slug = Str::slug($data['name']);
    $cocktailData['slug'] = $slug;

    if ($data['ice_option'] == 'yes') {
        $cocktailData['ice_id'] = $data['ice_id'];
    } else {
        $cocktailData['ice_id'] = null;
    }

    if ($data['variation_option'] == 'yes') {
        $cocktailData['variation'] = $data['variation'];
    } else {
        $cocktailData['variation'] = null;
    }

    if ($data['signature_option'] == 'yes') {
        $cocktailData['signature'] = $data['signature_text'];
    } else {
        $cocktailData['signature'] = null;
    }

    if ($data['garnish_option'] == 'yes') {
        $cocktailData['garnish'] = $data['garnish'];
    } else {
        $cocktailData['garnish'] = null;
    }

    if ($request->hasFile('image')) {
        $img_path = $request->file('image')->store('cocktails_img');
        $cocktailData['image'] = $img_path;
    }

    $cocktail = Cocktail::create($cocktailData);
    $ingredientsData = $data['ingredients'];

    foreach ($ingredientsData as $ingredientData) {
        $ingredient = new Ingredient($ingredientData);
        $cocktail->ingredients()->save($ingredient);
    }

    $equipmentsData = $data['equipements'];
    $cocktailEquipments = [];

    foreach ($equipmentsData as $equip) {
        $cocktailEquipment = [
            'cocktail_id' => $cocktail->id,
            'equipement_id' => $equip,
        ];

        $cocktailEquipments[] = $cocktailEquipment;
    }

    foreach ($cocktailEquipments as $cocktailEquipmentData) {
        $cocktailEquipment = new CocktailEquipement();
        $cocktailEquipment->cocktail_id = $cocktailEquipmentData['cocktail_id'];
        $cocktailEquipment->equipement_id = $cocktailEquipmentData['equipement_id'];
        $cocktailEquipment->save();
    }

    // Reindirizza l'utente alla pagina "show" del cocktail appena creato
    return redirect()->route('cocktails.show', ['slug' => $slug]);
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
