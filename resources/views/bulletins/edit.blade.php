@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-4">Modifier le bulletin</h2>

    <form action="{{ route('bulletins.update', $bulletin) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium">Élève</label>
            <select name="eleve_id" class="w-full mt-1 p-2 border rounded">
                @foreach($eleves as $eleve)
                    <option value="{{ $eleve->id }}" {{ $eleve->id == $bulletin->eleve_id ? 'selected' : '' }}>
                        {{ $eleve->nom }} {{ $eleve->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Classe</label>
            <select name="classe_id" class="w-full mt-1 p-2 border rounded">
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ $classe->id == $bulletin->classe_id ? 'selected' : '' }}>
                        {{ $classe->libelle }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Période</label>
            <select name="periode_id" class="w-full mt-1 p-2 border rounded">
                @foreach($periodes as $periode)
                    <option value="{{ $periode->id }}" {{ $periode->id == $bulletin->periode_id ? 'selected' : '' }}>
                        {{ $periode->libelle }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Mettre à jour</button>
            <a href="{{ route('bulletins.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
        </div>
    </form>
</div>
@endsection
