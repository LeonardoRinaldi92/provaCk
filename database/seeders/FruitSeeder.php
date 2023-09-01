<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Fruit;
use App\Models\Ingredient;

class FruitSeeder extends Seeder
{
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Arancia = Fruit::create(['name' => 'Arancia']);
        $Limone = Fruit::create(['name' => 'Limone']);
        $Lime = Fruit::create(['name' => 'Lime']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        $this->createIngredient($Arancia);
        $this->createIngredient($Limone);
        $this->createIngredient($Lime);
    }

    protected function createIngredient($fruit)
    {
        $ingredient = new Ingredient([
            'name' => $fruit->name,
            'ingredientable_type' => $fruit->getTable(),
            'ingredientable_id' => $fruit->id,
        ]);
        $ingredient->save();
    }
}
