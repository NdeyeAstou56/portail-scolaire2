@extends('layouts.app')

@section('title', 'Modifier un enseignant')

@section('content')
<div class="max-w-md mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold text-yellow-700 mb-6">Modifier un enseignant</h2>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('enseignants.update', $enseignant) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nom" class="block font-semibold mb-1">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $enseignant->nom) }}" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>

        <div class="mb-4">
            <label for="prenom" class="block font-semibold mb-1">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $enseignant->prenom) }}" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $enseignant->email) }}" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>

        <button type="submit" class="bg-yellow-600 text-white px-5 py-2 rounded hover:bg-yellow-700 transition">
            Mettre à jour
        </button>

        <a href="{{ route('enseignants.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
    </form>
</div>
@endsection
