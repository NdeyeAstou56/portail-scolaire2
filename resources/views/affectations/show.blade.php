@extends('layouts.app')

@section('title', 'Détail de l\'affectation')

@section('content')
<div class="max-w-md mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-6 text-indigo-700">Détail de l'affectation</h2>

    <p><strong>Enseignant :</strong> {{ $affectation->enseignant->nom }} {{ $affectation->enseignant->prenom }}</p>
    <p><strong>Matière :</strong> {{ $affectation->matiere->nom }}</p>
    <p><strong>Classe :</strong> {{ $affectation->classe->nom }}</p>

    <a href="{{ route('affectations.index') }}" class="inline-block mt-6 text-indigo-600 hover:underline">Retour à la liste</a>
</div>
@endsection
