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
        $Gin = Alcool::create(['name' => 'Gin']);
        $Campari = Alcool::create(['name' => 'Campari']);
        $Vermouth = Alcool::create(['name' => 'Vermouth Rosso']);
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
            'ingredientable_type' => Alcool::class,
            'ingredientable_id' => $alcool->id,
        ]);
        $ingredient->save();
    }
}
