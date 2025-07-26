<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\Classe;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function index()
    {
        // Paginate enseignants par ordre alphabétique sur nom
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
            'email' => 'required|email|unique:enseignants,email',
        ]);

        Enseignant::create($request->only(['nom', 'prenom', 'email']));

        return redirect()->route('enseignants.index')->with('success', 'Enseignant ajouté.');
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
