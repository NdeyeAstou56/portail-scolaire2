@extends('layouts.app')

@section('title', 'Ajouter un enseignant')

@section('content')
<div class="max-w-md mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Ajouter un enseignant</h2>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('enseignants.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-4">
            <label for="nom" class="block font-semibold mb-1">Nom</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="prenom" class="block font-semibold mb-1">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
            Ajouter
        </button>

        <a href="{{ route('enseignants.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
    </form>
</div>
@endsection
