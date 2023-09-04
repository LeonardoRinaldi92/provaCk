<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\AromaticBitter;
use App\Models\Ingredient;
class AromaticBitterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Angostura = AromaticBitter::create(['name' => 'Angostura','ABV' => 30,'description' =>'Bitter speziato', 'image' => 'ciao sono una foto', 'slug' => 'angostura']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        // $this->createIngredient($Angostura);
    }

    // protected function createIngredient($bitter)
    // {
    //     $ingredient = new Ingredient([
    //         'ingredientable_type' => $bitter->getTable(),
    //         'ingredientable_id' => $bitter->id,
    //     ]);
    //     $ingredient->save();
    // }
}
