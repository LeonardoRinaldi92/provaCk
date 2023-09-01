<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Soda;
use App\Models\Ingredient;

class SodaSeeder extends Seeder
{
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Tonica = Soda::create(['name' => 'Acqua Tonica']);
        $Lemon = Soda::create(['name' => 'Tonica al Limone']);
        $Soda = Soda::create(['name' => 'Soda']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        // $this->createIngredient($Tonica);
        // $this->createIngredient($Lemon);
        // $this->createIngredient($Soda);
    }

    // protected function createIngredient($soda)
    // {
    //     $ingredient = new Ingredient([
    //         'name' => $soda->name,
    //         'ingredientable_type' => $soda->getTable(),
    //         'ingredientable_id' => $soda->id,
    //     ]);
    //     $ingredient->save();
    // }
}
