{{-- resources/views/notes/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-blue-700 mb-6 border-b pb-2">📄 Détails de la Note</h2>

        <div class="space-y-4 text-gray-800">
            <p><span class="font-bold">👩‍🎓 Élève :</span> {{ $note->eleve->prenom }} {{ $note->eleve->nom }}</p>
            <p><span class="font-bold">📘 Matière :</span> {{ $note->matiere->nom }}</p>
            <p><span class="font-bold">🗓️ Période :</span> {{ $note->periode->nom }}</p>
            <p><span class="font-bold">📝 Note :</span> {{ $note->note }}/20</p>
        </div>

        <div class="mt-8 flex gap-4">
            <a href="{{ route('notes.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded transition">
                🔙 Retour
            </a>
            <a href="{{ route('notes.edit', $note->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition">
                ✏️ Modifier
            </a>
            <form action="{{ route('notes.destroy', $note->id) }}" method="POST"
                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded transition">
                    🗑️ Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
