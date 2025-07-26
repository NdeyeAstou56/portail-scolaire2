@extends('layouts.app')

@section('title', 'Modifier un élève')

@section('content')
<div class="max-w-md mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Modifier un élève</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('eleves.update', $eleve) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div class="mb-4">
            <label for="nom" class="block font-semibold mb-1">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $eleve->nom) }}" required
                @class([
                    'w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 transition',
                    'border-red-500 focus:ring-red-400' => $errors->has('nom'),
                    'border-indigo-300 focus:ring-indigo-400' => !$errors->has('nom'),
                ])>
            @error('nom') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Prénom -->
        <div class="mb-4">
            <label for="prenom" class="block font-semibold mb-1">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $eleve->prenom) }}" required
                @class([
                    'w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 transition',
                    'border-red-500 focus:ring-red-400' => $errors->has('prenom'),
                    'border-indigo-300 focus:ring-indigo-400' => !$errors->has('prenom'),
                ])>
            @error('prenom') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $eleve->email) }}" required
                @class([
                    'w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 transition',
                    'border-red-500 focus:ring-red-400' => $errors->has('email'),
                    'border-indigo-300 focus:ring-indigo-400' => !$errors->has('email'),
                ])>
            @error('email') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Date de naissance -->
        <div class="mb-4">
            <label for="date_naissance" class="block font-semibold mb-1">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $eleve->date_naissance) }}" required
                @class([
                    'w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 transition',
                    'border-red-500 focus:ring-red-400' => $errors->has('date_naissance'),
                    'border-indigo-300 focus:ring-indigo-400' => !$errors->has('date_naissance'),
                ])>
            @error('date_naissance') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Classe -->
        <div class="mb-4">
            <label for="classe_id" class="block font-semibold mb-1">Classe</label>
            <select name="classe_id" id="classe_id" required
                @class([
                    'w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 transition',
                    'border-red-500 focus:ring-red-400' => $errors->has('classe_id'),
                    'border-indigo-300 focus:ring-indigo-400' => !$errors->has('classe_id'),
                ])>
                <option value="" disabled>-- Sélectionner une classe --</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('classe_id', $eleve->classe_id) == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom }}
                    </option>
                @endforeach
            </select>
            @error('classe_id') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Document justificatif -->
        <div class="mb-4">
            <label for="document_justificatif" class="block font-semibold mb-1">Document justificatif</label>

            @if ($eleve->document_justificatif)
                <p class="mb-2">
                    Document actuel : 
                    <a href="{{ asset('uploads/eleves/' . $eleve->document_justificatif) }}" target="_blank" class="text-blue-600 underline">
                        Voir le document
                    </a>
                </p>
            @endif

            <input type="file" name="document_justificatif" id="document_justificatif"
                @class([
                    'w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 transition',
                    'border-red-500 focus:ring-red-400' => $errors->has('document_justificatif'),
                    'border-indigo-300 focus:ring-indigo-400' => !$errors->has('document_justificatif'),
                ])
                accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
            <p class="text-sm text-gray-500 mt-1">Laissez vide pour garder le document actuel</p>
            @error('document_justificatif') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex space-x-3 mt-6">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                Mettre à jour
            </button>
            <a href="{{ route('eleves.index') }}" class="bg-gray-300 px-5 py-2 rounded hover:bg-gray-400">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
