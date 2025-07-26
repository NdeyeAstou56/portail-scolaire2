@extends('layouts.app')

@section('title', 'Détails de la matière')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-3xl font-bold mb-6 text-indigo-700">Matière : {{ $matiere->nom }}</h1>

    <div class="mb-4">
        <strong>Coefficient :</strong> {{ $matiere->coefficient }}
    </div>

    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-3 text-indigo-600">Affectations (Classe - Enseignant)</h2>
        @if($matiere->affectations && $matiere->affectations->count())
            <ul class="list-disc list-inside space-y-1">
                @foreach($matiere->affectations as $affectation)
                    <li>
                        Classe : {{ $affectation->classe->nom ?? 'N/A' }} (Niveau : {{ $affectation->classe->niveau->nom ?? 'N/A' }}) — 
                        Enseignant : {{ $affectation->enseignant->nom ?? 'N/A' }} {{ $affectation->enseignant->prenom ?? '' }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucune affectation (classe + enseignant) pour cette matière.</p>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('matieres.index') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            Retour à la liste des matières
        </a>
    </div>
</div>
@endsection
