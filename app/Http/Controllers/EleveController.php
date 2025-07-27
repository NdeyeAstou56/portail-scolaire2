<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;      
use App\Models\Bulletin;  

class EleveController extends Controller
{
    // Affiche tous les élèves
    public function index()
    {
        $eleves = Eleve::with('classe')->get();
        return view('eleves.index', compact('eleves'));
    }

    // Affiche le formulaire d’ajout
    public function create()
    {
        $classes = Classe::all();
        return view('eleves.create', compact('classes'));
    }

    // Enregistre un nouvel élève
public function store(Request $request)
{
    $validated = $request->validate([
    'nom' => 'required|string',
    'prenom' => 'required|string',
    'email' => 'required|email|unique:eleves,email',
    'date_naissance' => 'required|date|before:today',
    'classe_id' => 'required|exists:classes,id',
    'document_justificatif' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
]);

$validated['identifiant'] = strtolower($request->nom . '.' . $request->prenom . '.' . rand(1000, 9999));

// Récupérer la date de naissance explicitement
$validated['date_naissance'] = $request->input('date_naissance');

// Gérer le fichier uploadé
if ($request->hasFile('document_justificatif')) {
    $file = $request->file('document_justificatif');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/eleves'), $filename);
    $validated['document_justificatif'] = $filename;
}

// Debug: vérifie bien que les données sont prêtes avant création
// dd($validated);

Eleve::create($validated);


    return redirect()->route('eleves.index')->with('success', 'Élève ajouté avec succès.');
}

    // Affiche un seul élève
    public function show(Eleve $eleve)
    {
        return view('eleves.show', compact('eleve'));
    }

    // Formulaire de modification
    public function edit(Eleve $eleve)
    {
        $classes = Classe::all();
        return view('eleves.edit', compact('eleve', 'classes'));
    }

  /**
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\Eleve  $eleve
 */
public function update(Request $request, Eleve $eleve)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => "required|email|unique:eleves,email,{$eleve->id}",
        'classe_id' => 'required|exists:classes,id',
        'date_naissance' => 'required|date|before:today',

        'document_justificatif' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['nom', 'prenom', 'email', 'classe_id', 'date_naissance']);

    if ($request->hasFile('document_justificatif')) {
        // Supprimer l’ancien fichier s’il existe
        if ($eleve->document_justificatif && file_exists(public_path('uploads/eleves/' . $eleve->document_justificatif))) {
            unlink(public_path('uploads/eleves/' . $eleve->document_justificatif));
        }

        // Sauvegarder le nouveau fichier
        $file = $request->file('document_justificatif');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/eleves'), $filename);
        $data['document_justificatif'] = $filename;
    }

    $eleve->update($data);

    return redirect()->route('eleves.index')->with('success', 'Élève modifié avec succès.');
}



    // Suppression d’un élève
    public function destroy(Eleve $eleve)
{
    if ($eleve->document_justificatif && file_exists(public_path('uploads/eleves/' . $eleve->document_justificatif))) {
        unlink(public_path('uploads/eleves/' . $eleve->document_justificatif));
    }

    $eleve->delete();
    return redirect()->route('eleves.index')->with('success', 'Élève supprimé.');
}
    public function portailEleve()
    {
        $user = Auth::user();

        // Récupérer les notes récentes (exemple : 5 dernières notes)
        $recentNotes = Note::where('eleve_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        // Récupérer les bulletins liés à l'élève
        $bulletins = Bulletin::where('eleve_id', $user->id)
                    ->orderByDesc('created_at')
                    ->get();

        // Exemple d'info supplémentaire (à adapter selon ta logique)
        $nextCourse = "Mathématiques - Lundi 8h00";
        $currentYear = "2024-2025";

        return view('eleves.dashboard', compact('recentNotes', 'bulletins', 'nextCourse', 'currentYear'));
    }

}
