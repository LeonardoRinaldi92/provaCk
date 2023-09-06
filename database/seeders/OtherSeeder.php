<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Other;
use App\Models\Ingredient;

class OtherSeeder extends Seeder
{
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Albume = Other::create(['name' => 'Albume']);
        $Menta = Other::create(['name' => 'Menta']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        // $this->createIngredient($Albume);
        // $this->createIngredient($Menta);
    }

    // protected function createIngredient($other)
    // {
    //     $ingredient = new Ingredient([
    //         'name' => $other->name,
    //         'ingredientable_type' => $other->getTable(),
    //         'ingredientable_id' => $other->id,
    //     ]);
    //     $ingredient->save();
    // }
}
