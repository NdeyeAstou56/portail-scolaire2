<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Enseignant;
use App\Models\Matiere;
use App\Models\Classe;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    /**
     * Affiche la liste paginée des affectations.
     */
    public function index()
    {
        $affectations = Affectation::with(['enseignant', 'matiere', 'classe'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('affectations.index', compact('affectations'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle affectation.
     */
    public function create()
    {
        $enseignants = Enseignant::orderBy('nom')->get();
        $matieres = Matiere::orderBy('nom')->get();
        $classes = Classe::orderBy('nom')->get();

        return view('affectations.create', compact('enseignants', 'matieres', 'classes'));
    }

    /**
     * Enregistre une nouvelle affectation en base.
     */
    public function store(Request $request)
{
    // Validation des champs requis
    $request->validate([
        'enseignant_id' => 'required|exists:enseignants,id',
        'matiere_id' => 'required|exists:matieres,id',
        'classe_id' => 'required|exists:classes,id',
    ], [
        'enseignant_id.required' => 'Le champ enseignant est obligatoire.',
        'matiere_id.required' => 'Le champ matière est obligatoire.',
        'classe_id.required' => 'Le champ classe est obligatoire.',
    ]);

    // Vérifie si la combinaison existe déjà
    $alreadyAssigned = Affectation::where('enseignant_id', $request->enseignant_id)
        ->where('matiere_id', $request->matiere_id)
        ->where('classe_id', $request->classe_id)
        ->exists();

    if ($alreadyAssigned) {
        return back()
            ->withInput()
            ->withErrors([
                'duplicate' => 'Cette affectation (enseignant + matière + classe) existe déjà.',
            ]);
    }

    // Enregistrement
    Affectation::create($request->only(['enseignant_id', 'matiere_id', 'classe_id']));

    return redirect()
        ->route('affectations.index')
        ->with('success', 'Affectation créée avec succès.');
}


    /**
     * Affiche les détails d'une affectation.
     */
    public function show(Affectation $affectation)
    {
        $affectation->load(['enseignant', 'matiere', 'classe']);
        return view('affectations.show', compact('affectation'));
    }

    /**
     * Affiche le formulaire d'édition d'une affectation.
     */
    public function edit(Affectation $affectation)
    {
        $enseignants = Enseignant::orderBy('nom')->get();
        $matieres = Matiere::orderBy('nom')->get();
        $classes = Classe::orderBy('nom')->get();

        return view('affectations.edit', compact('affectation', 'enseignants', 'matieres', 'classes'));
    }

    /**
     * Met à jour une affectation existante.
     */
    public function update(Request $request, Affectation $affectation)
    {
        $request->validate([
            'enseignant_id' => 'required|exists:enseignants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'classe_id' => 'required|exists:classes,id',
        ]);

        // Vérifier qu'on ne duplique pas une autre affectation
        $exists = Affectation::where('enseignant_id', $request->enseignant_id)
            ->where('matiere_id', $request->matiere_id)
            ->where('classe_id', $request->classe_id)
            ->where('id', '!=', $affectation->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['Cette affectation existe déjà'])->withInput();
        }

        $affectation->update($request->only(['enseignant_id', 'matiere_id', 'classe_id']));

        return redirect()->route('affectations.index')->with('success', 'Affectation mise à jour avec succès.');
    }

    /**
     * Supprime une affectation.
     */
    public function destroy(Affectation $affectation)
    {
        $affectation->delete();
        return redirect()->route('affectations.index')->with('success', 'Affectation supprimée.');
    }
}
