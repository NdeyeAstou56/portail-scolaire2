@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-8 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Détails de l'année scolaire</h2>

    <div class="mb-4">
        <strong>Libellé:</strong>
        <p>{{ $annee->libelle }}</p>
    </div>

    <div class="mb-4">
        <strong>Active:</strong>
        <p>{{ $annee->active ? 'Oui' : 'Non' }}</p>
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('annees.index') }}" class="text-blue-600 hover:underline">Retour à la liste</a>
        <a href="{{ route('annees.edit', $annee) }}" class="text-yellow-600 hover:underline">Modifier</a>
    </div>
</div>
@endsection
