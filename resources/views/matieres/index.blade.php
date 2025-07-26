@extends('layouts.app')

@section('title', 'Liste des Matières')

@section('content')
<div class="max-w-7xl mx-auto bg-white rounded shadow p-6">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Liste des Matières</h2>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('matieres.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        + Ajouter une matière
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 rounded-md">
            <thead class="bg-blue-100 text-blue-700 font-semibold text-left">
                <tr>
                    <th class="px-4 py-2 border-b border-gray-300">Nom</th>
                    <th class="px-4 py-2 border-b border-gray-300 text-center">Coefficient</th>
                    <th class="px-4 py-2 border-b border-gray-300">Classe</th>
                    <th class="px-4 py-2 border-b border-gray-300">Enseignant</th>
                    <th class="px-4 py-2 border-b border-gray-300 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matieres as $matiere)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b border-gray-300">{{ $matiere->nom }}</td>
                    <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $matiere->coefficient }}</td>
                    <td class="px-4 py-2 border-b border-gray-300">
                        
                        {{ $matiere->classe->nom ?? '-' }} ({{ $matiere->classe->niveau->nom ?? '' }})

                    </td>
                    <td class="px-4 py-2 border-b border-gray-300">
                        {{ $matiere->enseignant ? $matiere->enseignant->prenom . ' ' . $matiere->enseignant->nom : '-' }}
                    </td>
                    <td class="px-4 py-2 border-b border-gray-300 text-center space-x-2">
                        <a href="{{ route('matieres.show', $matiere) }}" 
                           class="text-blue-500 hover:text-yellow-700 font-semibold">Voir</a>
                        <a href="{{ route('matieres.edit', $matiere) }}" 
                           class="text-yellow-500 hover:text-yellow-700 font-semibold">Modifier</a>
                        <form action="{{ route('matieres.destroy', $matiere) }}" method="POST" class="inline" 
                              onsubmit="return confirm('Supprimer cette matière ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Aucune matière trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
