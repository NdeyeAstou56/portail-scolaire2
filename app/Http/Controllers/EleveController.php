<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;      
use App\Models\Bulletin;  
use App\Models\User;
use Illuminate\Support\Facades\Hash;


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

        // Champs parent
        'parent_nom' => 'required|string',
        'parent_prenom' => 'required|string',
        'parent_email' => 'required|email|unique:users,email',
    ]);

    // Création du compte parent
    $parent = User::create([
        'name' => $request->parent_nom . ' ' . $request->parent_prenom,
        'email' => $request->parent_email,
        'password' => Hash::make('Parent123'),
        'role' => 'parent',
    ]);

    // Génération identifiant élève
    $validated['identifiant'] = strtolower($request->nom . '.' . $request->prenom . '.' . rand(1000, 9999));

    // Upload document
    if ($request->hasFile('document_justificatif')) {
        $file = $request->file('document_justificatif');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/eleves'), $filename);
        $validated['document_justificatif'] = $filename;
    }

    // Création du compte élève
    $userEleve = User::create([
        'name' => $request->nom . ' ' . $request->prenom,
        'email' => $request->email,
        'password' => Hash::make('Eleve123'),
        'role' => 'eleve',
    ]);

    // Création de l’élève
    $eleve = new Eleve($validated);
    $eleve->user()->associate($userEleve);
    $eleve->save();

    // ➕ Création de la relation dans la table pivot eleve_parent
    $eleve->parents()->attach($parent->id);

    return redirect()->route('eleves.index')->with('success', 'Élève et parent ajoutés avec succès.');
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
    $user = auth()->user();

    if (!$user) {
        return "Utilisateur non authentifié"; // pour debug, tu peux remplacer par abort(403)
    }

    $eleve = $user->eleve;

    if (!$eleve) {
        return ".."; 
    }


    // récupère les notes récentes et les bulletins liés à cet élève
    $recentNotes = $eleve->notes()->latest()->take(5)->get();
    $moyenne = $recentNotes->avg('note');  // ou 'valeur' selon ta colonne

    $bulletins = $eleve->bulletins()->with(['annee_scolaire', 'periode'])->latest()->get();

    return view('eleves.dashboard', compact('eleve', 'recentNotes', 'bulletins','moyenne'));
}






    public function assignUserToEleve(Request $request)
{
    $request->validate([
        'eleve_id' => 'required|exists:eleves,id',
        'user_id' => 'required|exists:users,id',
    ]);

    $user = User::where('role', 'eleve')->findOrFail($request->user_id);
    $eleve = Eleve::findOrFail($request->eleve_id);

    $eleve->user()->associate($user);
    $eleve->save();

    return redirect()->back()->with('success', 'Utilisateur associé à l’élève avec succès.');
}
public function portailParent()
{
    $parent = auth()->user();

    if (!$parent) {
        abort(403, 'Non authentifié');
    }

    $eleves = $parent->eleves()->with(['notes' => fn ($q) => $q->latest()->take(5), 'bulletins.annee_scolaire', 'bulletins.periode'])->get();

    return view('parent.dashboard', compact('parent', 'eleves'));
}




}
