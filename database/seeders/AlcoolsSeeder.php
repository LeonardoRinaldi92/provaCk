<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Alcool;
use App\Models\Ingredient;

class AlcoolsSeeder extends Seeder
{
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Gin = Alcool::create(['name' => 'Gin Secco','ABV' => '40','description' =>'Qualunque Gin','image' => 'ciao sono una foto', 'alcool_categories_id' => 1]);
        $Campari = Alcool::create(['name' => 'Campari','ABV' => '25', 'description' =>'Famosissimo bitter di casa Campari','image' => 'ciao sono una foto', 'alcool_categories_id' => 3]);
        $Vermouth = Alcool::create(['name' => 'Vermouth Rosso Dolce','ABV' => '14', 'description' =>'Qualunque Vermouth','image' => 'ciao sono una foto', 'alcool_categories_id' => 2]);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        // $this->createIngredient($Gin);
        // $this->createIngredient($Campari);
        // $this->createIngredient($Vermouth);
    }

    // protected function createIngredient($alcool)
    // {
    //     $ingredient = new Ingredient([
    //         'ingredientable_type' => Alcool::class,
    //         //cambia
    //         'ingredientable_id' => $alcool->id,
    //     ]);
    //     $ingredient->save();
    // }
}
