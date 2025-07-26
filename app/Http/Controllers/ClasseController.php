<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\Niveau;

class ClasseController extends Controller
{

    

public function create()
{
    $niveaux = Niveau::all(); // récupère tous les niveaux existants
    return view('classes.create', compact('niveaux'));
}


    // Affiche toutes les classes
   public function index()
{
    $classes = Classe::with('niveau')->get(); // Eager loading de la relation 'niveau'
    return view('classes.index', compact('classes'));
}


    // Affiche le formulaire de création
   

    // Enregistre une nouvelle classe
   public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:100',
        'niveau_id' => 'required|exists:niveaux,id',  // validation correcte
    ]);

    Classe::create([
        'nom' => $request->nom,
        'niveau_id' => $request->niveau_id, // enregistrement de l'id du niveau
    ]);

    return redirect()->route('classes.index')->with('success', 'Classe créée avec succès.');
}


    // Affiche une seule classe (optionnel)
 public function show($id)
{
    $classe = Classe::with(['affectations.enseignant', 'affectations.matiere'])->findOrFail($id);

    return view('classes.show', compact('classe'));
}



    // Formulaire de modification
   public function edit($id)
{
    $classe = Classe::findOrFail($id);
    $niveaux = Niveau::all(); // récupère tous les niveaux pour le select
    return view('classes.edit', compact('classe', 'niveaux'));
}


    // Mise à jour
    public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'niveau_id' => 'required|exists:niveaux,id',
    ]);

    $classe = Classe::findOrFail($id);
    $classe->nom = $request->nom;
    $classe->niveau_id = $request->niveau_id;
    $classe->save();

    return redirect()->route('classes.index')->with('success', 'Classe modifiée avec succès.');
}

    // Suppression
    public function destroy($id)
    {
        $classe = Classe::findOrFail($id);
        $classe->delete();

        return redirect()->route('classes.index')->with('success', 'Classe supprimée.');
    }
}
