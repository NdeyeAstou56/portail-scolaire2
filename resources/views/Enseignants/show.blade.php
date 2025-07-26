@extends('layouts.app')

@section('title', 'Détails de l\'enseignant')

@section('content')
<div class="max-w-md mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Détails de l'enseignant</h2>

    <p><strong>Nom :</strong> {{ $enseignant->nom }}</p>
    <p><strong>Prénom :</strong> {{ $enseignant->prenom }}</p>
    <p><strong>Email :</strong> {{ $enseignant->email }}</p>

    <a href="{{ route('enseignants.index') }}" class="inline-block mt-6 text-blue-600 hover:underline">Retour à la liste</a>
</div>

<h3 class="text-xl font-semibold mt-8 mb-4">Affectations</h3>

@if($enseignant->affectations->count())
    <ul class="list-disc ml-6">
        @foreach($enseignant->affectations as $aff)
            <li>
                Classe : {{ $aff->classe->nom ?? 'N/A' }} — Matière : {{ $aff->matiere->nom ?? 'N/A' }}
            </li>
        @endforeach
    </ul>
@else
    <p>Aucune affectation pour cet enseignant.</p>
@endif

@endsection
