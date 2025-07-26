<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use Illuminate\Http\Request;

class AnneeScolaireController extends Controller
{
    public function index()
    {
        $annees = AnneeScolaire::all();
        return view('annees.index', compact('annees'));
    }

    public function create()
    {
        return view('annees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:50',
            'active' => 'boolean',
        ]);

        AnneeScolaire::create([
            'libelle' => $request->libelle,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('annees.index')->with('success', 'Année créée.');
    }

    public function show(AnneeScolaire $annee)
    {
        return view('annees.show', compact('annee'));
    }

    public function edit(AnneeScolaire $annee)
    {
        return view('annees.edit', compact('annee'));
    }

    public function update(Request $request, AnneeScolaire $annee)
    {
        $request->validate([
            'libelle' => 'required|string|max:50',
            'active' => 'boolean',
        ]);

        $annee->update([
            'libelle' => $request->libelle,
            'active' => $request->has('active'),
        ]);

        return redirect()->route('annees.index')->with('success', 'Année modifiée.');
    }

    public function destroy(AnneeScolaire $annee)
    {
        $annee->delete();
        return redirect()->route('annees.index')->with('success', 'Année supprimée.');
    }
}
