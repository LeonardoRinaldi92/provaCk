<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Juice;
use App\Models\Ingredient;

class JuiceSeeder extends Seeder
{
    public function run()
    {
        // Crea alcuni esempi di alcools
        $Arancia = Juice::create(['name' => 'Succo di Arancia']);
        $Limone = Juice::create(['name' => 'Succo di Limone']);
        $Pompelmo = Juice::create(['name' => 'Pompelmo']);
        // Aggiungi altri alcools se necessario
        
        // Crea i record corrispondenti nella tabella ingredients
        // $this->createIngredient($Arancia);
        // $this->createIngredient($Limone);
        // $this->createIngredient($Pompelmo);
    }

    // protected function createIngredient($juice)
    // {
    //     $ingredient = new Ingredient([
    //         'name' => $juice->name,
    //         'ingredientable_type' => $juice->getTable(),
    //         'ingredientable_id' => $juice->id,
    //     ]);
    //     $ingredient->save();
    // }
}
