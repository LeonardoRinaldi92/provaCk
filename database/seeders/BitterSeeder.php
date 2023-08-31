<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Bitter;
use App\Models\Ingredient;
class BitterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Angostura = Bitter::create(['name' => 'Angostura','ABV' => '45']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        $this->createIngredient($Angostura);
    }

    protected function createIngredient($bitter)
    {
        $ingredient = new Ingredient([
            'name' => $bitter->name,
            'ingredientable_type' => $bitter->getTable(),
            'ingredientable_id' => $bitter->id,
        ]);
        $ingredient->save();
    }
}
