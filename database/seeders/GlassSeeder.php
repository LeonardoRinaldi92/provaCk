<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Glass;
use App\Models\Ingredient;

class GlassSeeder extends Seeder
{
    public function run()
    {
        // Esempi di dati per i bicchieri
        $glassesData = [
            [
                'name' => 'Bicchiere Alto',
                'image' => 'path/to/your/image1.jpg',
                'description' => 'Un bicchiere alto per cocktail.',
                'slug' => 'bicchiere-alto'
            ],
            [
                'name' => 'Bicchiere Old Fashioned',
                'image' => 'path/to/your/image2.jpg',
                'description' => 'Un bicchiere Old Fashioned per cocktail.',
                'slug' => 'bicchiere-old-fashioned'
            ],
            // Aggiungi altri dati se necessario
        ];

        // Cicla attraverso i dati e crea i record nella tabella 'glasses'
        foreach ($glassesData as $glassData) {
            Glass::create($glassData);
        }
    }
}
