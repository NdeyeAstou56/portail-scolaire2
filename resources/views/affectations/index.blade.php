@extends('layouts.app')

@section('title', 'Gestion des affectations')

@section('content')
<div class="container mx-auto p-4 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-indigo-700">Affectations Enseignant - Matière - Classe</h1>

    <a href="{{ route('affectations.create') }}" class="inline-block mb-4 bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-700 transition">
        + Nouvelle affectation
    </a>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($affectations->count())
    <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-indigo-100">
                <th class="border border-gray-300 py-2 px-4 text-left">Enseignant</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Matière</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Classe</th>
                <th class="border border-gray-300 py-2 px-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($affectations as $affectation)
            <tr class="hover:bg-indigo-50">
                <td class="border border-gray-300 py-2 px-4">{{ $affectation->enseignant->nom }} {{ $affectation->enseignant->prenom }}</td>
                <td class="border border-gray-300 py-2 px-4">{{ $affectation->matiere->nom }}</td>
                <td class="border border-gray-300 py-2 px-4">{{ $affectation->classe->nom }}</td>
                <td class="border border-gray-300 py-2 px-4 text-center space-x-2">
                    <a href="{{ route('affectations.show', $affectation) }}" class="text-indigo-600 hover:underline">Voir</a>
                    <a href="{{ route('affectations.edit', $affectation) }}" class="text-yellow-600 hover:underline">Modifier</a>
                    <form action="{{ route('affectations.destroy', $affectation) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?');">
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
        {{ $affectations->links() }}
    </div>
    @else
    <p class="text-gray-600">Aucune affectation trouvée.</p>
    @endif
</div>
@endsection
