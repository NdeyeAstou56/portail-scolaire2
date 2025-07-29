<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Bulletin;
use App\Models\Eleve;
use App\Models\Periode;
use App\Models\Classe;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletins = Bulletin::with('eleve', 'periode')->get();
        return view('bulletins.index', compact('bulletins'));
    }

    public function create()
    {
        $eleves = Eleve::all();
        $classes = Classe::all(); // Utile si on veut filtrer ou afficher les classes
        $periodes = Periode::all();

        return view('bulletins.create', compact('eleves', 'classes', 'periodes'));
    }

public function show(Bulletin $bulletin)
{
    $bulletin->load(['eleve.user', 'eleve.classe', 'periode', 'annee_scolaire', 'notes.matiere', 'notes.enseignant.user']);

    // Regrouper les notes par matière
    $detailsNotes = [];

    $grouped = $bulletin->notes->groupBy('matiere_id');

    foreach ($grouped as $matiereId => $notes) {
        $matiere = $notes->first()->matiere ?? null;
        if (!$matiere) continue;

        $coeff = $matiere->coefficient ?? 1;
        $valeurs = $notes->pluck('note')->filter(function($v) { return is_numeric($v); })->map(fn($v) => floatval($v));

        $moyenne = $valeurs->avg() ?? 0;
        $note_min = $valeurs->min() ?? 0;
        $note_max = $valeurs->max() ?? 0;
        $points = $moyenne * $coeff;

        $detailsNotes[] = [
            'matiere' => $matiere,
            'notes' => $notes,
            'coefficient' => $coeff,
            'moyenne' => $moyenne,
            'note_min' => $note_min,
            'note_max' => $note_max,
            'points' => $points,
        ];
    }

    return view('bulletins.show', compact('bulletin', 'detailsNotes'));
}



    public function edit(Bulletin $bulletin)
    {
        $eleves = Eleve::all();
        $classes = Classe::all(); // Ajout cohérent avec create()
        $periodes = Periode::all();

        return view('bulletins.edit', compact('bulletin', 'eleves', 'classes', 'periodes'));
    }

    public function update(Request $request, Bulletin $bulletin)
{
    $request->validate([
        'eleve_id' => 'required|exists:eleves,id',
        'periode_id' => 'required|exists:periodes,id',
        'moyenne_generale' => 'nullable|numeric|min:0|max:20',
        'mention' => 'nullable|string|max:50',
        'rang' => 'nullable|integer|min:1',
        'appreciation' => 'nullable|string|max:255',
        'fichier' => 'nullable|file|mimes:pdf|max:2048',
        'annee_scolaire_id' => 'required|exists:annee_scolaires,id',

    ]);

    $data = $request->except('fichier');

    if ($request->hasFile('fichier')) {
        // Supprimer l'ancien fichier si existe
        if ($bulletin->fichier) {
            $oldPath = storage_path('app/bulletins/' . $bulletin->fichier);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $fichier = $request->file('fichier');
        $nomFichier = time() . '_' . $fichier->getClientOriginalName();
        $fichier->storeAs('bulletins', $nomFichier);
        $data['fichier'] = $nomFichier;
    }

    $bulletin->update($data);

    return redirect()->route('bulletins.index')->with('success', 'Bulletin mis à jour.');
}

    public function download($id)
{
    $bulletin = Bulletin::with(['eleve', 'periode'])->findOrFail($id);

    // Vérification d'autorisation (exemple simple)
    if (!auth()->user()->eleve || auth()->user()->eleve->id !== $bulletin->eleve_id) {
        abort(403, 'Accès interdit.');
    }

    if (empty($bulletin->fichier)) {
        abort(404, 'Fichier non associé à ce bulletin.');
    }

    $relativePath = 'bulletins/' . basename($bulletin->fichier);

    if (!Storage::disk('local')->exists($relativePath)) {
        abort(404, 'Fichier introuvable.');
    }

    $nomEleve = $bulletin->eleve->nom ?? 'eleve';
    $periode  = $bulletin->periode->nom ?? 'periode';
    $downloadName = 'bulletin_' . $periode . '_' . $nomEleve . '.pdf';

    return Storage::disk('local')->download($relativePath, $downloadName);
}


    public function destroy(Bulletin $bulletin)
    {
        $bulletin->delete();
        return redirect()->route('bulletins.index')->with('success', 'Bulletin supprimé.');
    }
}
