<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Ice;
use App\Models\Ingredient;

class IceSeeder extends Seeder
{
    public function run()
    {
        // Esempi di dati per il ghiaccio
        $icesData = [
            [
                'name' => 'Ghiaccio cubetti',
                'image' => 'path/to/your/image1.jpg',
                'description' => 'Cubetti di ghiaccio per raffreddare i cocktail.'
            ],
            [
                'name' => 'Ghiaccio tritato',
                'image' => 'path/to/your/image2.jpg',
                'description' => 'Ghiaccio tritato per mescolare con i cocktail.'
            ],
            // Aggiungi altri dati se necessario
        ];

        // Cicla attraverso i dati e crea i record nella tabella 'ices'
        foreach ($icesData as $iceData) {
            Ice::create($iceData);
        }
    }
}