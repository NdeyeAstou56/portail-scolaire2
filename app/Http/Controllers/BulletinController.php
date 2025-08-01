<?php

namespace App\Http\Controllers;
use App\Mail\BulletinParentDisponibleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Bulletin;
use App\Models\Eleve;
use App\Models\Periode;
use App\Models\Classe;

class BulletinController extends Controller
{
    public function index()
    {
        $bulletins = Bulletin::with('eleve.user', 'periode', 'classe')->get();
        return view('bulletins.index', compact('bulletins'));
    }

    public function create()
    {
        $eleves = Eleve::all();
        $classes = Classe::all();
        $periodes = Periode::all();

        return view('bulletins.create', compact('eleves', 'classes', 'periodes'));
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'classe_id' => 'required|exists:classes,id',
            'periode_id' => 'required|exists:periodes,id',
        ]);

        // Création du bulletin
        $bulletin = Bulletin::create($validated);

        // Recharger avec relations nécessaires
        $bulletin->load('eleve.user', 'eleve.classe', 'periode', 'annee_scolaire', 'notes.matiere', 'notes.enseignant.user');

        // Calcul des détails des notes (mêmes règles que dans show)
        $detailsNotes = [];
        $grouped = $bulletin->notes->groupBy('matiere_id');

        foreach ($grouped as $matiereId => $notes) {
            $matiere = $notes->first()->matiere ?? null;
            if (!$matiere) continue;

            $coeff = $matiere->coefficient ?? 1;
            $valeurs = $notes->map(function ($note) {
                $val = $note->valeur ?? $note->note ?? null;
                return is_numeric($val) ? floatval($val) : null;
            })->filter();

            $moyenne = $valeurs->avg() ?? 0;
            $points = $moyenne * $coeff;

            $detailsNotes[] = [
                'matiere' => $matiere,
                'notes' => $notes,
                'coefficient' => $coeff,
                'moyenne' => $moyenne,
                'points' => $points,
            ];
        }

        // Générer PDF avec détails
        $pdf = Pdf::loadView('bulletins.pdf', compact('bulletin', 'detailsNotes'));

        // Nom & chemin fichier PDF
        $filename = 'bulletin-' . $bulletin->id . '.pdf';
        $path = 'public/bulletins/' . $filename;

        // Stocker PDF
        Storage::put($path, $pdf->output());

        // Mettre à jour champ fichier
        $bulletin->fichier = 'bulletins/' . $filename;
        $bulletin->save();

        // Envoyer mail si email disponible
        if ($bulletin->eleve?->user?->email) {
            Mail::to($bulletin->eleve->user->email)->send(new \App\Mail\BulletinDisponibleMail($bulletin));
        }

       if ($bulletin->eleve?->parent?->email) {
    Mail::to($bulletin->eleve->parent->email)
        ->send(new BulletinParentDisponibleMail($bulletin));
}


        return redirect()->route('bulletins.index')->with('success', 'Bulletin créé, PDF généré et mail envoyé.');
    }

    public function show(Bulletin $bulletin)
    {
        $bulletin->load([
            'eleve.user',
            'eleve.classe',
            'periode',
            'annee_scolaire',
            'notes.matiere',
            'notes.enseignant.user'
        ]);

        $detailsNotes = [];
        $grouped = $bulletin->notes->groupBy('matiere_id');

        foreach ($grouped as $matiereId => $notes) {
            $matiere = $notes->first()->matiere ?? null;
            if (!$matiere) continue;

            $coeff = $matiere->coefficient ?? 1;
            $valeurs = $notes->map(function ($note) {
                $val = $note->valeur ?? $note->note ?? null;
                return is_numeric($val) ? floatval($val) : null;
            })->filter();

            $moyenne = $valeurs->avg() ?? 0;
            $points = $moyenne * $coeff;

            $detailsNotes[] = [
                'matiere' => $matiere,
                'notes' => $notes,
                'coefficient' => $coeff,
                'moyenne' => $moyenne,
                'points' => $points,
            ];
        }

        // Moyenne générale pondérée
        $total_points = array_sum(array_column($detailsNotes, 'points'));
        $total_coeffs = array_sum(array_column($detailsNotes, 'coefficient'));
        $moyenne_generale = $total_coeffs > 0 ? $total_points / $total_coeffs : 0;

        $bulletin->moyenne = $moyenne_generale;
        $bulletin->rang = 1; // TODO : calcul réel

        // Mention selon moyenne
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
            'classe_id' => 'required|exists:classes,id',
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
            if ($bulletin->fichier) {
                $oldPath = storage_path('app/public/' . $bulletin->fichier);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $fichier = $request->file('fichier');
            $nomFichier = time() . '_' . $fichier->getClientOriginalName();
            $fichier->storeAs('public/bulletins', $nomFichier);
            $data['fichier'] = 'bulletins/' . $nomFichier;
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
            'notes.enseignant.user'
        ])->findOrFail($id);

        $user = auth()->user();
        if (!$user->eleve || $user->eleve->id !== $bulletin->eleve_id) {
            abort(403, 'Accès interdit.');
        }

        if (empty($bulletin->fichier)) {
            abort(404, 'Fichier non associé à ce bulletin.');
        }

        $detailsNotes = [];
        $grouped = $bulletin->notes->groupBy('matiere_id');

        foreach ($grouped as $matiereId => $notes) {
            $matiere = $notes->first()->matiere ?? null;
            if (!$matiere) continue;

            $coeff = $matiere->coefficient ?? 1;
            $valeurs = $notes->map(function ($note) {
                $val = $note->valeur ?? $note->note ?? null;
                return is_numeric($val) ? floatval($val) : null;
            })->filter();

            $moyenne = $valeurs->avg() ?? 0;

            $detailsNotes[] = [
                'matiere' => $matiere,
                'notes' => $notes,
                'coefficient' => $coeff,
                'moyenne' => $moyenne,
            ];
        }

        $pdf = Pdf::loadView('bulletins.pdf', compact('bulletin', 'detailsNotes'));

        $nomEleve = $bulletin->eleve->user->nom ?? 'eleve';
        $periode = $bulletin->periode->libelle ?? 'periode';
        $downloadName = 'bulletin_' . str_replace(' ', '_', strtolower($periode)) . '_' . str_replace(' ', '_', strtolower($nomEleve)) . '.pdf';

        return $pdf->download($downloadName);
    }

    public function destroy(Bulletin $bulletin)
    {
        // Supprimer fichier PDF si existe
        if ($bulletin->fichier) {
            $filePath = storage_path('app/public/' . $bulletin->fichier);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $bulletin->delete();
        return redirect()->route('bulletins.index')->with('success', 'Bulletin supprimé.');
    }
}
