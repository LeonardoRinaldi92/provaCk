<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creazione di un utente di esempio
        User::create([
            'name' => 'leonardo',
            'email' => 'lello@lello',
            'password' => Hash::make('leonardo'), // Assicurati di hashare la password
        ]);
    }
}
