@extends('layouts.app')

@section('title', 'Liste des enseignants')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Enseignants</h1>

    <a href="{{ route('enseignants.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Ajouter un enseignant
    </a>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($enseignants->count())
    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b">Nom</th>
                <th class="py-2 px-4 border-b">Prénom</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enseignants as $enseignant)
            <tr>
                <td class="py-2 px-4 border-b">{{ $enseignant->nom }}</td>
                <td class="py-2 px-4 border-b">{{ $enseignant->prenom }}</td>
                <td class="py-2 px-4 border-b">{{ $enseignant->email }}</td>
                <td class="py-2 px-4 border-b text-center space-x-2">
                    <a href="{{ route('enseignants.show', $enseignant) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('enseignants.edit', $enseignant) }}" class="text-yellow-600 hover:underline">Modifier</a>
                    <form action="{{ route('enseignants.destroy', $enseignant) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $enseignants->links() }}
    </div>
    @else
    <p>Aucun enseignant trouvé.</p>
    @endif
</div>
@endsection
