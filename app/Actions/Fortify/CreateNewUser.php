<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Eleve;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CreateNewUser
{
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        // Générer l’identifiant élève
        $countEleves = User::where('role', 'eleve')->count() + 1;
        $identifiantEleve = 'ELV' . now()->year . str_pad($countEleves, 4, '0', STR_PAD_LEFT);

        // Créer l'élève
        $eleve = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => 'eleve',
            'identifiant' => $identifiantEleve,
        ]);

        // Générer un identifiant parent
        $countParents = User::where('role', 'parent')->count() + 1;
        $identifiantParent = 'PRT' . now()->year . str_pad($countParents, 4, '0', STR_PAD_LEFT);
        $parentEmail = 'parent' . $countParents . '@ecole.com';
        $parentPassword = Str::random(8);

        // Créer le parent
        $parent = User::create([
            'name' => 'Parent de ' . $input['name'],
            'email' => $parentEmail,
            'password' => Hash::make($parentPassword),
            'role' => 'parent',
            'identifiant' => $identifiantParent,
        ]);

        // Lier l’élève au parent
        Eleve::create([
            'user_id' => $eleve->id,
            'parent_id' => $parent->id,
        ]);
        

        return $eleve;
    }
}
