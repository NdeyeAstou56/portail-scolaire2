@extends('layouts.app')

@section('title', 'Modifier une affectation')

@section('content')
<div class="max-w-full sm:max-w-md mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold text-yellow-700 mb-6">Modifier une affectation</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('affectations.update', $affectation) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        {{-- Enseignant --}}
        <div class="mb-4">
            <label for="enseignant_id" class="block font-semibold mb-1 text-gray-700">
                Enseignant <span class="text-red-500">*</span>
            </label>
            <select id="enseignant_id" name="enseignant_id" required aria-required="true"
                class="w-full border rounded px-3 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="">Sélectionnez un enseignant</option>
                @foreach($enseignants as $enseignant)
                    <option value="{{ $enseignant->id }}"
                        {{ old('enseignant_id', $affectation->enseignant_id) == $enseignant->id ? 'selected' : '' }}>
                        {{ $enseignant->nom }} {{ $enseignant->prenom }}
                    </option>
                @endforeach
            </select>
            @error('enseignant_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Matière --}}
        <div class="mb-4">
            <label for="matiere_id" class="block font-semibold mb-1 text-gray-700">
                Matière <span class="text-red-500">*</span>
            </label>
            <select id="matiere_id" name="matiere_id" required aria-required="true"
                class="w-full border rounded px-3 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="">Sélectionnez une matière</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}"
                        {{ old('matiere_id', $affectation->matiere_id) == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->nom }}
                    </option>
                @endforeach
            </select>
            @error('matiere_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Classe --}}
        <div class="mb-4">
            <label for="classe_id" class="block font-semibold mb-1 text-gray-700">
                Classe <span class="text-red-500">*</span>
            </label>
            <select id="classe_id" name="classe_id" required aria-required="true"
                class="w-full border rounded px-3 py-2 bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="">Sélectionnez une classe</option>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}"
                        {{ old('classe_id', $affectation->classe_id) == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom }}
                    </option>
                @endforeach
            </select>
            @error('classe_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Boutons --}}
        <div class="flex items-center justify-between mt-6">
            <button type="submit"
                class="bg-yellow-600 text-white px-5 py-2 rounded hover:bg-yellow-700 transition">
                Mettre à jour
            </button>
            <a href="{{ route('affectations.index') }}" class="text-gray-600 hover:underline">Annuler</a>
        </div>
    </form>
</div>
@endsection
