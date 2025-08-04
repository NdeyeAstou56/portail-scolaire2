@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-6 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-lg shadow-lg max-w-3xl">
    <h2 class="text-3xl font-extrabold mb-8 text-indigo-700 drop-shadow-md">Inscription d'un élève</h2>

    <form action="{{ route('eleves.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-8 rounded-xl shadow-md space-y-6">
        @csrf

        <div>
            <label class="block text-indigo-800 font-semibold mb-2" for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                class="w-full border border-indigo-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
            @error('nom') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-indigo-800 font-semibold mb-2" for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required
                class="w-full border border-indigo-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
            @error('prenom') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-indigo-800 font-semibold mb-2" for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full border border-indigo-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-indigo-800 font-semibold mb-2" for="date_naissance">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required
                max="{{ date('Y-m-d') }}"
                class="w-full border border-indigo-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
            @error('date_naissance') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-indigo-800 font-semibold mb-2" for="classe_id">Classe</label>
            <select id="classe_id" name="classe_id" required
                class="w-full border border-indigo-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                <option value="">-- Sélectionner une classe --</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}" {{ old('classe_id') == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom }}
                    </option>
                @endforeach
            </select>
            @error('classe_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-indigo-800 font-semibold mb-2" for="document_justificatif">Document justificatif (PDF ou image)</label>
            <input type="file" id="document_justificatif" name="document_justificatif" accept=".pdf,image/*" required
                class="w-full border border-indigo-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
            @error('document_justificatif') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <fieldset class="border-t border-indigo-200 pt-6">
    <legend class="text-xl font-bold text-indigo-700 mb-4">Informations du parent</legend>

    <div class="mb-4">
        <label for="parent_nom" class="block font-semibold text-indigo-800">Nom du parent</label>
        <input type="text" name="parent_nom" id="parent_nom" value="{{ old('parent_nom') }}" required
               class="w-full border border-indigo-300 rounded-lg px-4 py-3">
        @error('parent_nom') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label for="parent_prenom" class="block font-semibold text-indigo-800">Prénom du parent</label>
        <input type="text" name="parent_prenom" id="parent_prenom" value="{{ old('parent_prenom') }}" required
               class="w-full border border-indigo-300 rounded-lg px-4 py-3">
        @error('parent_prenom') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label for="parent_email" class="block font-semibold text-indigo-800">Email du parent</label>
        <input type="email" name="parent_email" id="parent_email" value="{{ old('parent_email') }}" required
               class="w-full border border-indigo-300 rounded-lg px-4 py-3">
        @error('parent_email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
</fieldset>


        <button type="submit" 
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
            Enregistrer
        </button>
    </form>
</div>
@endsection
