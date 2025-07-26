@extends('layouts.app')

@section('title', 'Ajouter une classe')

@section('content')
<div class="max-w-md mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Ajouter une classe</h2>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('classes.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-4">
            <label for="nom" class="block font-semibold mb-1">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                   class="w-full border rounded px-3 py-2 @error('nom') border-red-500 @enderror">
            @error('nom') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
    <label for="niveau" class="block font-semibold mb-1">Niveau</label>
    <select name="niveau_id" id="niveau" required
        class="w-full border rounded px-3 py-2 @error('niveau_id') border-red-500 @enderror">
        <option value="">-- Sélectionnez un niveau --</option>
        @foreach ($niveaux as $niveau)
            <option value="{{ $niveau->id }}" {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>
                {{ $niveau->nom }}
            </option>
        @endforeach
    </select>
    @error('niveau_id') <p class="text-red-600 mt-1 text-sm">{{ $message }}</p> @enderror
</div>


        <div class="flex space-x-3">
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                Ajouter
            </button>
            <a href="{{ route('classes.index') }}" class="bg-gray-300 px-5 py-2 rounded hover:bg-gray-400">Annuler</a>
        </div>
    </form>
</div>
@endsection
