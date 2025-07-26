@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-4">Créer un bulletin</h2>

    <form action="{{ route('bulletins.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block text-sm font-medium">Élève</label>
            <select name="eleve_id" class="w-full mt-1 p-2 border rounded">
                @foreach($eleves as $eleve)
                    <option value="{{ $eleve->id }}">{{ $eleve->nom }} {{ $eleve->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
    <label for="classe_id" class="block text-gray-700 font-semibold mb-2">Classe</label>
    <select name="classe_id" id="classe_id" class="w-full border border-gray-300 rounded px-3 py-2 text-black">
        <option value="">-- Sélectionner une classe --</option>
        @foreach($classes as $classe)
            <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
        @endforeach
    </select>
</div>

        <div>
            <label class="block text-sm font-medium">Période</label>
            <select name="periode_id" class="w-full mt-1 p-2 border rounded">
                @foreach($periodes as $periode)
                    <option value="{{ $periode->id }}">{{ $periode->libelle }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Enregistrer</button>
            <a href="{{ route('bulletins.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
        </div>
    </form>
</div>
@endsection
