@extends('layouts.app')

@section('title', 'Détails de la classe')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-3xl font-bold mb-6 text-indigo-700">Classe : {{ $classe->nom }}</h1>

    <div class="mb-4">
        <strong>Niveau :</strong> {{ $classe->niveau->libelle ?? 'Non défini' }}
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Enseignants affectés</h2>

        @if($classe->enseignants->count())
            <ul class="list-disc list-inside space-y-1">
                @foreach($classe->enseignants as $enseignant)
                    <li>
                        {{ $enseignant->nom }} {{ $enseignant->prenom }}
                        @php
                            $matiere = $enseignant->pivot->matiere_id
                                ? \App\Models\Matiere::find($enseignant->pivot->matiere_id)
                                : null;
                        @endphp
                        @if($matiere)
                            – Matière : {{ $matiere->nom }}
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Aucun enseignant affecté.</p>
        @endif
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Matières affectées</h2>

        @if($classe->matieresAffectees->count())
            <ul class="list-disc list-inside space-y-1">
                @foreach($classe->matieresAffectees as $matiere)
                    <li>
                        {{ $matiere->nom }}
                        @php
                            $enseignant = $matiere->pivot->enseignant_id
                                ? \App\Models\Enseignant::find($matiere->pivot->enseignant_id)
                                : null;
                        @endphp
                        @if($enseignant)
                            – Enseignant : {{ $enseignant->nom }} {{ $enseignant->prenom }}
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Aucune matière affectée.</p>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('classes.index') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            Retour à la liste des classes
        </a>
    </div>
</div>
@endsection
