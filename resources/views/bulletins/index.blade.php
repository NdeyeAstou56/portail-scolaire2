@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📄 Liste des Bulletins</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('bulletins.create') }}"
       class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow transition duration-300">
        ➕ Ajouter un bulletin
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow-md">
            <thead class="bg-gray-200 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="py-3 px-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0H4.5z" />
                        </svg>
                        Élève
                    </th>
                    <th class="py-3 px-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Classe
                    </th>
                    <th class="py-3 px-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2v-6H3v6a2 2 0 002 2z" />
                        </svg>
                        Période
                    </th>
                    <th class="py-3 px-4 text-center flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 4.487a2.25 2.25 0 113.182 3.182L7.5 20.182H3v-4.5L16.862 4.487z" />
                        </svg>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($bulletins as $bulletin)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $bulletin->eleve->nom ?? '-' }}</td>
                        <td class="py-2 px-4">{{ $bulletin->classe->libelle ?? '-' }}</td>
                        <td class="py-2 px-4">{{ $bulletin->periode->libelle ?? '-' }}</td>
                        <td class="py-2 px-4 space-x-2 text-sm text-center">
                            <a href="{{ route('bulletins.show', $bulletin) }}"
                               class="inline-block text-blue-500 hover:text-blue-700 transition">👁️ Voir</a>
                            <a href="{{ route('bulletins.edit', $bulletin) }}"
                               class="inline-block text-yellow-500 hover:text-yellow-600 transition">✏️ Modifier</a>
                            <form action="{{ route('bulletins.destroy', $bulletin) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-500 hover:text-red-600 transition">🗑️ Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
