<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Classe;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::with('classe', 'enseignant')->get();
        return view('matieres.index', compact('matieres'));
    }

   public function create()
{
    $classes = Classe::all();
    $enseignants = Enseignant::all();
    return view('matieres.create', compact('classes', 'enseignants'));
}




    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'coefficient' => 'required|numeric|min:1',
            'classe_id' => 'required|exists:classes,id',
            'enseignant_id' => 'nullable|exists:enseignants,id',
        ]);

        Matiere::create($request->only(['nom', 'coefficient', 'classe_id', 'enseignant_id']));

        return redirect()->route('matieres.index')->with('success', 'Matière enregistrée.');
    }

    public function show(Matiere $matiere)
    {
        // Charger les affectations liées à cette matière (classes, enseignants)
        $matiere->load(['affectations.classe', 'affectations.enseignant']);

        return view('matieres.show', compact('matiere'));
    }

    public function edit(Matiere $matiere)
{
    $classes = Classe::all();
    $enseignants = Enseignant::all();
    return view('matieres.edit', compact('matiere', 'classes', 'enseignants'));
}

    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'coefficient' => 'required|numeric|min:1',
            'classe_id' => 'required|exists:classes,id',
            'enseignant_id' => 'nullable|exists:enseignants,id',
        ]);

        $matiere->update($request->only(['nom', 'coefficient', 'classe_id', 'enseignant_id']));

        return redirect()->route('matieres.index')->with('success', 'Matière modifiée.');
    }

    public function destroy(Matiere $matiere)
    {
        $matiere->delete();
        return redirect()->route('matieres.index')->with('success', 'Matière supprimée.');
    }
}
