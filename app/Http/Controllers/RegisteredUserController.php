<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
  public function store(Request $request)
{
    $request->validate([
        'role' => ['required', 'in:admin,enseignant,eleve,parent'],
        'name' => ['required', 'string', 'max:255'],
    ]);

    // Générer email et mot de passe automatiques pour élèves et parents
    if (in_array($request->role, ['eleve', 'parent'])) {
        $timestamp = now()->timestamp;
        $email = strtolower($request->role) . $timestamp . '@ecole.com';
        $password = 'password'; // mot de passe par défaut
    } else {
        // Pour admin ou enseignant, demander email et mot de passe
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $email = $request->email;
        $password = $request->password;
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $email,
        'password' => Hash::make($password),
        'role' => $request->role,
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}

}
