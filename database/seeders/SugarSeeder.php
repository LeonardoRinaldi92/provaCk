<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sugar;
use App\Models\Ingredient;

class SugarSeeder extends Seeder
{
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Bianco = Sugar::create(['name' => 'Zucchero Bianco', 'slug' => 'zucchero-bianco', 'description' => 'Classico zucchero bianco']);
        $Canna = Sugar::create(['name' => 'Zucchero di Canna', 'slug' => 'zucchero-di-canna', 'description' => 'Classico zucchero di canna']);
        $Zolletta = Sugar::create(['name' => 'Zolletta di zucchero', 'slug' => 'zolletta-di-zucchero', 'description' => 'Classico zucchero a zollette']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        // $this->createIngredient($Bianco);
        // $this->createIngredient($Canna);
        // $this->createIngredient($Zolletta);
    }

    // protected function createIngredient($sugar)
    // {
    //     $ingredient = new Ingredient([
    //         'name' => $sugar->name,
    //         'ingredientable_type' => $sugar->getTable(),
    //         'ingredientable_id' => $sugar->id,
    //     ]);
    //     $ingredient->save();
    // }
}

