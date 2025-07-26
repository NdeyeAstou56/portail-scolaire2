{{-- resources/views/notes/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-blue-700 mb-4 border-b pb-2">➕ Ajouter une Note</h2>

        {{-- Affichage des erreurs de validation --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium text-gray-700 mb-1">Élève</label>
                <select name="eleve_id" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Choisir un élève --</option>
                    @foreach ($eleves as $eleve)
                        <option value="{{ $eleve->id }}" {{ old('eleve_id') == $eleve->id ? 'selected' : '' }}>
                            {{ $eleve->prenom }} {{ $eleve->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Matière</label>
                <select name="matiere_id" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Choisir une matière --</option>
                    @foreach ($matieres as $matiere)
                        <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>
                            {{ $matiere->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

           <div>
    <label class="block font-medium text-gray-700 mb-1">Période</label>
    <select name="periode_id" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-black bg-white">
        <option value="">-- Choisir une période --</option>
        @foreach ($periodes as $periode)
            <option value="{{ $periode->id }}" {{ old('periode_id') == $periode->id ? 'selected' : '' }}>
                {{ $periode->libelle }}
            </option>
        @endforeach
    </select>
</div>


            <div>
                <label class="block font-medium text-gray-700 mb-1">Note (/20)</label>
                <input type="number" name="note" step="0.1" min="0" max="20"
                       class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('note') }}" required>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('notes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded transition duration-200">
                    🔙 Annuler
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-200">
                    💾 Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
