@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Modifier le niveau : {{ $niveau->nom }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('niveaux.update', $niveau->id) }}" method="POST" class="max-w-md">
        @csrf
        @method('PUT')

        <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom du niveau</label>
        <input
            type="text"
            name="nom"
            id="nom"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            value="{{ old('nom', $niveau->nom) }}"
            required
        >

        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Mettre à jour
            </button>
            <a href="{{ route('niveaux.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
