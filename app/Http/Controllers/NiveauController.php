<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    // Afficher la liste des niveaux
    public function index()
    {
        $niveaux = Niveau::orderBy('nom')->get();
        return view('niveaux.index', compact('niveaux'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('niveaux.create');
    }

    // Enregistrer un nouveau niveau
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:niveaux,nom',
        ]);

        Niveau::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('niveaux.index')->with('success', 'Niveau ajouté avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit(Niveau $niveau)
    {
        return view('niveaux.edit', compact('niveau'));
    }

    // Mettre à jour un niveau
    public function update(Request $request, Niveau $niveau)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:niveaux,nom,' . $niveau->id,
        ]);

        $niveau->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('niveaux.index')->with('success', 'Niveau modifié avec succès.');
    }

    // Supprimer un niveau (optionnel)
    public function destroy(Niveau $niveau)
    {
        $niveau->delete();

        return redirect()->route('niveaux.index')->with('success', 'Niveau supprimé avec succès.');
    }
}
