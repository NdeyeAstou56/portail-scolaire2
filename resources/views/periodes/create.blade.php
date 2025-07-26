@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Ajouter une période</h2>

    <form action="{{ route('periodes.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Libellé</label>
            <input type="text" name="libelle" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
    <label class="block font-medium">Date de début</label>
    <input type="date" name="debut" class="w-full border rounded px-3 py-2" required>
</div>

<div>
    <label class="block font-medium">Date de fin</label>
    <input type="date" name="fin" class="w-full border rounded px-3 py-2" required>
</div>


        <div>
            <label class="block font-medium">Année scolaire</label>
            <select name="annee_scolaire_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Choisir --</option>
                @foreach($annees as $annee)
                    <option value="{{ $annee->id }}">{{ $annee->libelle }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
