<?php

// database/seeders/UsersSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@ecole.com'],
            [
                'name' => 'Admin Principal',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'identifiant' => 'ADM' . now()->year . '0001',
            ]
        );
    }
}


