<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

use App\Models\Ingredient;
use App\Models\Alcool;
use App\Models\AromaticBitter;
use App\Models\Fruit;
use App\Models\Juice;
use App\Models\Other;
use App\Models\Soda;
use App\Models\Sugar;
use App\Models\Syrup;
use Illuminate\Http\Request;

class AllIngredientController extends Controller
{
    public function index()
    {
        $alcools = Alcool::all();
        $aromaticBitters = AromaticBitter::all();
        $fruits = Fruit::all();
        $juices = Juice::all();
        $others = Other::all();
        $sodas = Soda::all();
        $sugars = Sugar::all();
        $syrups = Syrup::all();

        $ingredients = Collection::make([
            $alcools,
            $aromaticBitters,
            $fruits,
            $juices,
            $others,
            $sodas,
            $sugars,
            $syrups,
        ])->collapse()->sortBy('name');
    
        return view('ingredients.index', compact('ingredients'));
    }
}
