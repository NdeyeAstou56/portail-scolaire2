<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'periode_id' => 'required|exists:periodes,id',
            'moyenne_generale' => 'nullable|numeric|min:0|max:20',
            'mention' => 'nullable|string|max:50',
            'rang' => 'nullable|integer|min:1',
            'appreciation' => 'nullable|string|max:255',
        ]);

        Bulletin::create($request->all());

        return redirect()->route('bulletins.index')->with('success', 'Bulletin enregistré.');
    }

    public function show(Bulletin $bulletin)
    {
        return view('bulletins.show', compact('bulletin'));
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
        ]);

        $bulletin->update($request->all());

        return redirect()->route('bulletins.index')->with('success', 'Bulletin mis à jour.');
    }

    public function destroy(Bulletin $bulletin)
    {
        $bulletin->delete();
        return redirect()->route('bulletins.index')->with('success', 'Bulletin supprimé.');
    }
}
