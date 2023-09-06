<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlcoolCategory;

class AlcoolCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Gin'],
            ['name' => 'Vermouth Rosso'],
            ['name' => 'Bitter'],
            // Aggiungi altre categorie se necessario
        ];

        foreach ($categories as $category) {
            AlcoolCategory::create($category);
        }
    }
}
