<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cocktail;
use App\Models\Ingredient;

class CocktailSeeder extends Seeder
{
    public function run()
    {
        // Dati per il cocktail
        $cocktailData = [
            'name' => 'Negroni',
            'description' => 'Molto forte',
            'preparation' => 'Mischia tutto',
            'avg_ABV' => 30, // Cambia questo con il tuo valore reale
            'official_IBA' => true,
            'glass_id' => 1, // Cambia questo con l'ID corretto del bicchiere
            'ice_id' => 1, // Cambia questo con l'ID corretto del tipo di ghiaccio
            'garnish' => 'arancia',
            'straw' => false,
            'image' => 'path/to/your/image.jpg',
        ];

        // Creazione del cocktail
        $cocktail = Cocktail::create($cocktailData);

        // Aggiungi ingredienti al cocktail
        $ingredientsData = [
            [
                'ingredientable_type' => 'App\Models\Alcool', // Cambia questo con il tuo tipo di ingrediente
                'ingredientable_id' => 1, // Cambia questo con l'ID corretto dell'ingrediente
                'quantity' => 30, // Cambia questo con la quantità corretta
                'quantity_type' => 'ml'
            ],
            [
                'ingredientable_type' => 'App\Models\Alcool', // Cambia questo con il tuo tipo di ingrediente
                'ingredientable_id' => 2, // Cambia questo con l'ID corretto dell'ingrediente
                'quantity' => 30, // Cambia questo con la quantità corretta
                'quantity_type' => 'ml'
            ],
            [
                'ingredientable_type' => 'App\Models\Alcool', // Cambia questo con il tuo tipo di ingrediente
                'ingredientable_id' =>3, // Cambia questo con l'ID corretto dell'ingrediente
                'quantity' => 30, // Cambia questo con la quantità corretta
                'quantity_type' => 'ml'
            ],
            // Aggiungi altri ingredienti se necessario
        ];

        foreach ($ingredientsData as $ingredientData) {
            $ingredient = new Ingredient($ingredientData);
            $cocktail->ingredients()->save($ingredient);
        }
    }
}
