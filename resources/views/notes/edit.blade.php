{{-- resources/views/notes/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-blue-700 mb-4 border-b pb-2">✏️ Modifier la Note</h2>

        <form action="{{ route('notes.update', $note->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Élève</label>
                <select name="eleve_id" class="w-full border rounded p-2">
                    @foreach ($eleves as $eleve)
                        <option value="{{ $eleve->id }}" {{ $note->eleve_id == $eleve->id ? 'selected' : '' }}>
                            {{ $eleve->prenom }} {{ $eleve->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Matière</label>
                <select name="matiere_id" class="w-full border rounded p-2">
                    @foreach ($matieres as $matiere)
                        <option value="{{ $matiere->id }}" {{ $note->matiere_id == $matiere->id ? 'selected' : '' }}>
                            {{ $matiere->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Période</label>
                <select name="periode_id" class="w-full border rounded p-2">
                    @foreach ($periodes as $periode)
                        <option value="{{ $periode->id }}" {{ $note->periode_id == $periode->id ? 'selected' : '' }}>
                            {{ $periode->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Note (/20)</label>
                <input type="number" name="note" value="{{ $note->note }}" class="w-full border rounded p-2" step="0.1" min="0" max="20" required>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('notes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                    🔙 Annuler
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                    💾 Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
