<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Ingredient;

use App\Models\Alcool;

// class IngredientSeeder extends Seeder
// {
//     public function run()
//     {
//         // Esempi di ingredienti per Alcolici
//         $this->createIngredientForAlcolico('Alcolico 1', 2.5);
//         $this->createIngredientForAlcolico('Alcolico 2', 3.0);
//     }

//     protected function createIngredientForAlcolico($name, $quantity)
//     {
//         $alcolico = Alcolici::inRandomOrder()->first();

//         Ingredient::create([
//             'name' => $name,
//             'quantity' => $quantity,
//             'ingredientable_type' => Alcolici::class,
//             'ingredientable_id' => $alcolico->id,
//         ]);
//     }
// }