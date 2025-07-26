@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Créer une affectation</h2>

    <div class="bg-white p-6 rounded-lg shadow-md max-w-full sm:max-w-md mx-auto">
        <form action="{{ route('affectations.store') }}" method="POST">
            @csrf

            <!-- Enseignant -->
            <div class="mb-4">
                <label for="enseignant_id" class="block text-gray-700 font-medium mb-2">
                    Enseignant <span class="text-red-500">*</span>
                </label>
                <select name="enseignant_id" id="enseignant_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required aria-required="true">
                    <option value="">-- Choisir un enseignant --</option>
                    @foreach($enseignants as $enseignant)
                        <option value="{{ $enseignant->id }}" {{ old('enseignant_id') == $enseignant->id ? 'selected' : '' }}>
                            {{ $enseignant->nom }} {{ $enseignant->prenom }}
                        </option>
                    @endforeach
                </select>
                @error('enseignant_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Matière -->
            <div class="mb-4">
                <label for="matiere_id" class="block text-gray-700 font-medium mb-2">
                    Matière <span class="text-red-500">*</span>
                </label>
                <select name="matiere_id" id="matiere_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required aria-required="true">
                    <option value="">-- Choisir une matière --</option>
                    @foreach($matieres as $matiere)
                        <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>
                            {{ $matiere->nom }}
                        </option>
                    @endforeach
                </select>
                @error('matiere_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Classe -->
            <div class="mb-4">
                <label for="classe_id" class="block text-gray-700 font-medium mb-2">
                    Classe <span class="text-red-500">*</span>
                </label>
                <select name="classe_id" id="classe_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required aria-required="true">
                    <option value="">-- Choisir une classe --</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}
                        </option>
                    @endforeach
                </select>
                @error('classe_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
