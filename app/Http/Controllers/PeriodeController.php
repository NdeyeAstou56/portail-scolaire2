<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\AnneeScolaire;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::with('annee')->get();
        return view('periodes.index', compact('periodes'));
    }

    public function create()
    {
        $annees = AnneeScolaire::all();
        return view('periodes.create', compact('annees'));
    }

    public function store(Request $request)
{
    $request->validate([
        'libelle' => 'required|string|max:255',
        'annee_scolaire_id' => 'required|exists:annee_scolaires,id',
        'debut' => 'required|date',
        'fin' => 'required|date|after_or_equal:debut',
    ]);

    \App\Models\Periode::create([
        'libelle' => $request->libelle,
        'annee_scolaire_id' => $request->annee_scolaire_id,
        'debut' => $request->debut,
        'fin' => $request->fin,
    ]);

    return redirect()->route('periodes.index')->with('success', 'Période créée avec succès');
}


    public function show(Periode $periode)
    {
        return view('periodes.show', compact('periode'));
    }

    public function edit(Periode $periode)
    {
        $annees = AnneeScolaire::all();
        return view('periodes.edit', compact('periode', 'annees'));
    }

    public function update(Request $request, Periode $periode)
    {
        $request->validate([
            'libelle' => 'required|string|max:100',
            'annee_scolaire_id' => 'required|exists:annee_scolaires,id',
        ]);

        $periode->update($request->all());

        return redirect()->route('periodes.index')->with('success', 'Période modifiée.');
    }

    public function destroy(Periode $periode)
    {
        $periode->delete();
        return redirect()->route('periodes.index')->with('success', 'Période supprimée.');
    }
}
