@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Détail de la période</h2>

    <div class="bg-white shadow rounded p-4 space-y-2">
        <p><strong>Libellé :</strong> {{ $periode->libelle }}</p>
        <p><strong>Année scolaire :</strong> {{ $periode->annee->libelle ?? '—' }}</p>
        <p><strong>Début :</strong> {{ $periode->debut ?? '—' }}</p>
        <p><strong>Fin :</strong> {{ $periode->fin ?? '—' }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('periodes.index') }}" class="text-blue-600 hover:underline">← Retour à la liste</a>
    </div>
</div>
@endsection
