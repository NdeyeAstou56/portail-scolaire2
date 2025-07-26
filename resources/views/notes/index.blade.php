{{-- resources/views/notes/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-blue-700">📚 Liste des Notes</h2>
            <a href="{{ route('notes.create') }}"
               class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded transition">
                ➕ Nouvelle Note
            </a>
        </div>

        <table class="w-full table-auto border-collapse border border-gray-200 mt-4">
            <thead class="bg-gray-100 text-gray-800">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Élève</th>
                    <th class="border px-4 py-2">Matière</th>
                    <th class="border px-4 py-2">Période</th>
                    <th class="border px-4 py-2">Note</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notes as $note)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $note->eleve->prenom }} {{ $note->eleve->nom }}</td>
                    <td class="border px-4 py-2">{{ $note->matiere->nom }}</td>
                    <td class="border px-4 py-2">{{ $note->periode->libelle }}</td>

                    <td class="border px-4 py-2 font-bold">{{ $note->note }}/20</td>
                    <td class="border px-4 py-2 flex gap-2 justify-center">
                        <a href="{{ route('notes.show', $note->id) }}" class="text-blue-600 hover:underline">👁️ Voir</a>
                        <a href="{{ route('notes.edit', $note->id) }}" class="text-yellow-500 hover:underline">✏️ Modifier</a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Supprimer cette note ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Aucune note enregistrée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
