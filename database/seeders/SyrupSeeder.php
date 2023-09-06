<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Syrup;
use App\Models\Ingredient;

class SyrupSeeder extends Seeder
{
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Bianco = Syrup::create(['name' => 'Sciroppo di Zucchero Bianco']);
        $Canna = Syrup::create(['name' => 'Sciroppo di Zucchero di Canna']);
        $Fragola = Syrup::create(['name' => 'Sciroppo alla Fragola']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        // $this->createIngredient($Bianco);
        // $this->createIngredient($Canna);
        // $this->createIngredient($Fragola);
    }

    // protected function createIngredient($syrup)
    // {
    //     $ingredient = new Ingredient([
    //         'name' => $syrup->name,
    //         'ingredientable_type' => $syrup->getTable(),
    //         'ingredientable_id' => $syrup->id,
    //     ]);
    //     $ingredient->save();
    // }
}
