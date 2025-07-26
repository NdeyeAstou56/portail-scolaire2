@extends('layouts.app')

@section('title', 'Détail Élève')

@section('content')
<div class="max-w-md mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">
        Détail de l'élève {{ $eleve->nom }} {{ $eleve->prenom }}
    </h2>

    <div class="space-y-2 text-gray-800">
        <p><strong>Nom :</strong> {{ $eleve->nom }}</p>
        <p><strong>Prénom :</strong> {{ $eleve->prenom }}</p>
        <p><strong>Email :</strong> {{ $eleve->email }}</p>
        <p><strong>Date de naissance :</strong> {{ \Carbon\Carbon::parse($eleve->date_naissance)->format('d/m/Y') }}</p>
        <p><strong>Identifiant :</strong> {{ $eleve->identifiant }}</p>
        <p><strong>Classe :</strong> {{ $eleve->classe->nom ?? 'Non attribuée' }}</p>

        @if ($eleve->document_justificatif)
            <p>
                <strong>Document justificatif :</strong>
                <a href="{{ asset('uploads/eleves/' . $eleve->document_justificatif) }}" target="_blank" 
                   class="text-blue-600 underline hover:text-blue-800 transition">
                    Voir le document
                </a>
            </p>
        @endif
    </div>

    <a href="{{ route('eleves.index') }}" 
       class="inline-block mt-6 bg-gray-300 px-5 py-2 rounded hover:bg-gray-400 transition">
        Retour à la liste
    </a>
</div>
@endsection
