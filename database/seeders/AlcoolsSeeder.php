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
        $Gin = Alcool::create(['name' => 'Gin','ABV' => '40','description' =>'Qualunque Gin','image' => 'ciao sono una foto']);
        $Campari = Alcool::create(['name' => 'Campari','ABV' => '25', 'description' =>'Famosissimo bitter di casa Campari','image' => 'ciao sono una foto']);
        $Vermouth = Alcool::create(['name' => 'Vermouth Rosso','ABV' => '14', 'description' =>'Qualunque Vermouth','image' => 'ciao sono una foto']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        $this->createIngredient($Gin);
        $this->createIngredient($Campari);
        $this->createIngredient($Vermouth);
    }

    protected function createIngredient($alcool)
    {
        $ingredient = new Ingredient([
            'name' => $alcool->name,
            'ingredientable_type' => $alcool->getTable(),
            'ingredientable_id' => $alcool->id,
        ]);
        $ingredient->save();
    }
}
