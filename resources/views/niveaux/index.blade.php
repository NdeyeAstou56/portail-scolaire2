@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Liste des Niveaux</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('niveaux.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">Ajouter un niveau</a>

    <table class="min-w-full bg-white border border-gray-300 rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Nom du niveau</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($niveaux as $niveau)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b">{{ $niveau->id }}</td>
                <td class="py-2 px-4 border-b">{{ $niveau->nom }}</td>
                <td class="py-2 px-4 border-b space-x-2">
                    <a href="{{ route('niveaux.edit', $niveau->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Modifier</a>

                    <form action="{{ route('niveaux.destroy', $niveau->id) }}" method="POST" class="inline" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
