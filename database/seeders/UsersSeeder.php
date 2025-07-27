<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Création de l’admin uniquement s’il n’existe pas
        User::firstOrCreate(
            ['email' => 'admin@ecole.com'],
            [
                'name' => 'Admin Principal',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'identifiant' => 'ADM' . now()->year . '0001',
            ]
        );
        User::firstOrCreate(
            ['email' => 'enseignant@ecole.com'],
            [
                'name' => 'prof Principal',
                'password' => Hash::make('password'),
                'role' => 'enseignant',
                'identifiant' => 'AB23' . now()->year . '0001',
            ]
        );
    }
}
