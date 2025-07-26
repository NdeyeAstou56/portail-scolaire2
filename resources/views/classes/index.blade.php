@extends('layouts.app')

@section('title', 'Liste des classes')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Liste des classes</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('classes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
        Ajouter une classe
    </a>

    @if($classes->isEmpty())
        <p>Aucune classe trouvée.</p>
    @else
    <table class="min-w-full bg-white border border-gray-300 rounded shadow">
        <thead>
            <tr>
                <th class="border px-4 py-2 text-left">Nom</th>
                <th class="border px-4 py-2 text-left">Niveau</th>
                <th class="border px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $classe)
            <tr>
                <td class="border px-4 py-2">{{ $classe->nom }}</td>
                  <td>{{ $classe->niveau ? $classe->niveau->nom : 'Niveau inconnu' }}</td>
                <td class="border px-4 py-2 text-center space-x-2">
                     <a href="{{ route('classes.show', $classe) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('classes.edit', $classe) }}" class="text-yellow-600 hover:underline">Modifier</a>
                    <form action="{{ route('classes.destroy', $classe) }}" method="POST" class="inline"
                          onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
