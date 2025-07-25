<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Exécuter le seeder des utilisateurs personnalisés
        $this->call(UsersSeeder::class);
        
    }
}
