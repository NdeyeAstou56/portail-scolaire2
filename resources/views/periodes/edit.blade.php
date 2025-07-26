@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Modifier la période</h2>

    <form action="{{ route('periodes.update', $periode) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Libellé</label>
            <input type="text" name="libelle" value="{{ $periode->libelle }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium">Année scolaire</label>
            <select name="annee_scolaire_id" class="w-full border rounded px-3 py-2" required>
                @foreach($annees as $annee)
                    <option value="{{ $annee->id }}" @if($periode->annee_scolaire_id == $annee->id) selected @endif>
                        {{ $annee->libelle }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
    <label class="block font-medium">Date de début</label>
    <input type="date" name="debut" class="w-full border rounded px-3 py-2" required>
</div>

<div>
    <label class="block font-medium">Date de fin</label>
    <input type="date" name="fin" class="w-full border rounded px-3 py-2" required>
</div>

        <div class="flex justify-end">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</button>
        </div>
    </form>
</div>
@endsection
