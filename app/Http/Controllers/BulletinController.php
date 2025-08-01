<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Bulletin;
use App\Models\Eleve;
use App\Models\Periode;
use App\Models\Classe;

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
        $classes = Classe::all();
        $periodes = Periode::all();

        return view('bulletins.create', compact('eleves', 'classes', 'periodes'));
    }

   public function show(Bulletin $bulletin)
{
    // Charger les relations nécessaires (optimisation eager loading)
    $bulletin->load([
        'eleve.user',
        'eleve.classe',
        'periode',
        'annee_scolaire',
        'notes.matiere',
        'notes.enseignant.user'
    ]);

    $detailsNotes = [];

    // Grouper les notes par matière
    $grouped = $bulletin->notes->groupBy('matiere_id');

    foreach ($grouped as $matiereId => $notes) {
        $matiere = $notes->first()->matiere ?? null;
        if (!$matiere) continue;

        $coeff = $matiere->coefficient ?? 1;

        // Extraire les valeurs numériques des notes
        $valeurs = $notes->map(function ($note) {
            $val = $note->valeur ?? $note->note ?? null;
            return is_numeric($val) ? floatval($val) : null;
        })->filter();

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

    // Calcul de la moyenne générale pondérée
    $total_points = array_sum(array_column($detailsNotes, 'points'));
    $total_coeffs = array_sum(array_column($detailsNotes, 'coefficient'));

    $moyenne_generale = $total_coeffs > 0 ? $total_points / $total_coeffs : 0;

    // On injecte les valeurs dans l’objet $bulletin
    $bulletin->moyenne = $moyenne_generale;
    
    // Tu peux adapter la logique réelle de rang et mention ici
    $bulletin->rang = 1; // Valeur fixe pour test (à remplacer par ta logique)
    
    // Exemple de calcul de mention simple selon la moyenne
    if ($moyenne_generale >= 16) {
        $bulletin->mention = "TRES BIEN";
    } elseif ($moyenne_generale >= 14) {
        $bulletin->mention = "BIEN";
    } elseif ($moyenne_generale >= 12) {
        $bulletin->mention = "ASSEZ BIEN";
    } elseif ($moyenne_generale >= 10) {
        $bulletin->mention = "PASSABLE";
    } else {
        $bulletin->mention = null;
    }

    return view('bulletins.show', compact('bulletin', 'detailsNotes'));
}


    public function edit(Bulletin $bulletin)
    {
        $eleves = Eleve::all();
        $classes = Classe::all();
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
        $bulletin = Bulletin::with([
            'eleve.user',
            'eleve.classe',
            'periode',
            'annee_scolaire',
            'notes.matiere',
            'notes.enseignant.user',
        ])->findOrFail($id);

        // Vérification d'autorisation simple
        $user = auth()->user();
        if (!$user->eleve || $user->eleve->id !== $bulletin->eleve_id) {
            abort(403, 'Accès interdit.');
        }

        // Préparer les détails notes (comme dans show)
        $detailsNotes = [];
        $grouped = $bulletin->notes->groupBy('matiere_id');

        foreach ($grouped as $matiereId => $notes) {
            $matiere = $notes->first()->matiere ?? null;
            if (!$matiere) continue;

            $coeff = $matiere->coefficient ?? 1;
            $valeurs = $notes->map(function ($note) {
                return is_numeric($note->valeur ?? $note->note) ? floatval($note->valeur ?? $note->note) : null;
            })->filter();

            $moyenne = $valeurs->avg() ?? 0;

            $detailsNotes[] = [
                'matiere' => $matiere,
                'notes' => $notes,
                'coefficient' => $coeff,
                'moyenne' => $moyenne,
            ];
        }

        // Générer le PDF à la volée
        $pdf = Pdf::loadView('bulletins.pdf', compact('bulletin', 'detailsNotes'));

        $nomEleve = $bulletin->eleve->user->name ?? 'eleve';
        $periode  = $bulletin->periode->libelle ?? 'periode';

        $downloadName = 'bulletin_' . str_replace(' ', '_', strtolower($periode)) . '_' . str_replace(' ', '_', strtolower($nomEleve)) . '.pdf';

        return $pdf->download($downloadName);
    }

    public function destroy(Bulletin $bulletin)
    {
        $bulletin->delete();
        return redirect()->route('bulletins.index')->with('success', 'Bulletin supprimé.');
    }
}
