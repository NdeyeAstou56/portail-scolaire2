<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EnseignantController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::orderBy('nom')->paginate(10);
        return view('enseignants.index', compact('enseignants'));
    }

    public function create()
    {
        return view('enseignants.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);

    // Création de l'utilisateur lié
    $user = User::create([
        'name' => $request->nom . ' ' . $request->prenom,
        'email' => $request->email,
        'password' => Hash::make('password123'),
        'role' => 'enseignant', // si tu as un champ `role`
    ]);

    // Création de l’enseignant lié à l'utilisateur
    Enseignant::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => $user->password, // ou un champ inutile si tu relies à User uniquement
        'user_id' => $user->id,
    ]);

    return redirect()->route('enseignants.index')->with('success', 'Enseignant ajouté avec compte utilisateur.');
}
    public function show($id)
    {
        $enseignant = Enseignant::with(['affectations.classe', 'affectations.matiere'])->findOrFail($id);
        return view('enseignants.show', compact('enseignant'));
    }

    public function edit(Enseignant $enseignant)
    {
        return view('enseignants.edit', compact('enseignant'));
    }

    public function update(Request $request, Enseignant $enseignant)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants,email,' . $enseignant->id,
        ]);

        $enseignant->update($request->only(['nom', 'prenom', 'email']));

        return redirect()->route('enseignants.index')->with('success', 'Enseignant mis à jour.');
    }

    public function destroy(Enseignant $enseignant)
    {
        $enseignant->delete();
        return redirect()->route('enseignants.index')->with('success', 'Enseignant supprimé.');
    }
}
