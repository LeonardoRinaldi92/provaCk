<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Equipement;
use App\Models\Ingredient;

class EquipementSeeder extends Seeder
{
    public function run()
    {
        // Esempi di dati per gli strumenti da barman
        $equipementsData = [
            [
                'name' => 'Shaker',
                'image' => 'path/to/your/image1.jpg',
                'description' => 'Uno shaker per mescolare e raffreddare i cocktail.',
                'slug' => 'shaker'
            ],
            [
                'name' => 'Jigger',
                'image' => 'path/to/your/image2.jpg',
                'description' => 'Un jigger per misurare gli ingredienti con precisione.',
                'slug' => 'jigger'
            ],
            // Aggiungi altri dati se necessario
        ];

        // Cicla attraverso i dati e crea i record nella tabella 'equipements'
        foreach ($equipementsData as $equipementData) {
            Equipement::create($equipementData);
        }
    }
}