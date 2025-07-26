@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Détails du Bulletin</h2>

        <div class="mb-4">
            <strong>Élève :</strong> {{ $bulletin->eleve->nom ?? '' }} {{ $bulletin->eleve->prenom ?? '' }}
        </div>
        <div class="mb-4">
            <strong>Classe :</strong> {{ $bulletin->classe->libelle ?? '' }}
        </div>
        <div class="mb-4">
            <strong>Période :</strong> {{ $bulletin->periode->libelle ?? '' }}
        </div>

        <a href="{{ route('bulletins.index') }}" class="text-blue-600 hover:underline">← Retour à la liste</a>
    </div>
</div>
@endsection
