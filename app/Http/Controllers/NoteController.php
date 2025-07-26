<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Eleve;
use App\Models\Matiere;
use App\Models\Periode;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('eleve', 'matiere', 'periode')->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $eleves = Eleve::all();
        $matieres = Matiere::all();
        $periodes = Periode::all();
        return view('notes.create', compact('eleves', 'matieres', 'periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'matiere_id' => 'required|exists:matieres,id',
            'periode_id' => 'required|exists:periodes,id',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        Note::create($request->all());

        return redirect()->route('notes.index')->with('success', 'Note enregistrée.');
    }

    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        $eleves = Eleve::all();
        $matieres = Matiere::all();
        $periodes = Periode::all();
        return view('notes.edit', compact('note', 'eleves', 'matieres', 'periodes'));
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'eleve_id' => 'required|exists:eleves,id',
            'matiere_id' => 'required|exists:matieres,id',
            'periode_id' => 'required|exists:periodes,id',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        $note->update($request->all());

        return redirect()->route('notes.index')->with('success', 'Note mise à jour.');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note supprimée.');
    }
}
