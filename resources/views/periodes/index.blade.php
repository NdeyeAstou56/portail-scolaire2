@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Liste des périodes</h1>
        <a href="{{ route('periodes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter une période</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border rounded shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Libellé</th>
                <th class="p-2 border">Année scolaire</th>
                <th class="p-2 border">Début</th>
                <th class="p-2 border">Fin</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($periodes as $periode)
            <tr class="text-center">
                <td class="p-2 border">{{ $periode->libelle }}</td>
                <td class="p-2 border">{{ $periode->annee->libelle ?? '—' }}</td>
                <td class="p-2 border">{{ $periode->debut }}</td>
                <td class="p-2 border">{{ $periode->fin }}</td>
                <td class="p-2 border space-x-2">
                    <a href="{{ route('periodes.show', $periode) }}" class="text-blue-500 hover:underline">Voir</a>
                    <a href="{{ route('periodes.edit', $periode) }}" class="text-yellow-500 hover:underline">Modifier</a>
                    <form action="{{ route('periodes.destroy', $periode) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
