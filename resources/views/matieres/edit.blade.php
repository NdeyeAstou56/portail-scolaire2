@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">✏️ Modifier la Matière</h1>

    <form action="{{ route('matieres.update', $matiere) }}" method="POST">
        @csrf
        @method('PUT')
        @include('matieres._form', [
            'submitLabel' => 'Mettre à jour',
            'classes' => $classes,
            'enseignants' => $enseignants
        ])
    </form>
</div>
@endsection
