@extends('layouts.app')

@section('title', 'Liste des élèves')

@section('content')
<div class="container mx-auto px-6 py-8 bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen rounded-lg shadow-lg">
    <h2 class="text-3xl font-extrabold mb-6 text-indigo-700 drop-shadow-md">
        Liste des élèves
    </h2>

    <a href="{{ route('eleves.create') }}" 
       class="mb-6 inline-block bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition">
        + Ajouter un élève
    </a>

    <div class="bg-white rounded-xl shadow-lg overflow-x-auto">
        <table class="min-w-full table-auto text-left border-separate border-spacing-y-3">
            <thead>
                <tr class="bg-indigo-100 text-indigo-900 font-semibold text-lg rounded-t-lg">
                    <th class="px-6 py-4 rounded-l-lg">Nom</th>
                    <th class="px-6 py-4">Prénom</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Date de naissance</th>
                    <th class="px-6 py-4">Classe</th>
                    <th class="px-6 py-4">Document</th>
                    <th class="px-6 py-4 rounded-r-lg">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eleves as $eleve)
                <tr class="bg-indigo-50 hover:bg-indigo-200 transition rounded-lg shadow-sm">
                    <td class="px-6 py-3 font-medium text-indigo-800">{{ $eleve->nom }}</td>
                    <td class="px-6 py-3">{{ $eleve->prenom }}</td>
                    <td class="px-6 py-3 text-indigo-700">{{ $eleve->email }}</td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($eleve->date_naissance)->format('d/m/Y') }}</td>
                    <td class="px-6 py-3">{{ $eleve->classe->nom ?? 'Non attribuée' }}</td>
                    <td class="px-6 py-3">
                        @if ($eleve->document_justificatif)
                            <a href="{{ asset('uploads/eleves/' . $eleve->document_justificatif) }}" target="_blank" 
                               class="text-indigo-600 font-semibold hover:underline">
                               Voir
                            </a>
                        @else
                            <span class="text-gray-400 italic">Aucun</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 space-x-3 flex items-center">
                        <a href="{{ route('eleves.show', $eleve->id) }}" 
                           class="text-indigo-700 hover:text-indigo-900 font-semibold">
                           Voir
                        </a>
                        <a href="{{ route('eleves.edit', $eleve->id) }}" 
                           class="text-yellow-600 hover:text-yellow-800 font-semibold">
                           Modifier
                        </a>
                        <form action="{{ route('eleves.destroy', $eleve->id) }}" method="POST" onsubmit="return confirm('Supprimer cet élève ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 font-semibold cursor-pointer bg-transparent border-none p-0">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
