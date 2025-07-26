@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Liste des années scolaires</h1>

    <a href="{{ route('annees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Ajouter une année</a>

    @if(session('success'))
        <div class="mt-4 bg-green-100 text-green-800 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full mt-6 border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">Libellé</th>
                <th class="border p-2">Active</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($annees as $annee)
                <tr class="hover:bg-gray-50">
                    <td class="border p-2">{{ $annee->id }}</td>
                    <td class="border p-2">{{ $annee->libelle }}</td>
                    <td class="border p-2">
                        @if($annee->active)
                            <span class="text-green-600 font-semibold">Oui</span>
                        @else
                            <span class="text-red-600 font-semibold">Non</span>
                        @endif
                    </td>
                    <td class="border p-2 space-x-2">
                        <a href="{{ route('annees.show', $annee) }}" class="text-blue-500 hover:underline">Voir</a>
                        <a href="{{ route('annees.edit', $annee) }}" class="text-yellow-500 hover:underline">Modifier</a>
                        <form action="{{ route('annees.destroy', $annee) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Supprimer cette année ?')" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
