<form action="{{ isset($matiere) ? route('matieres.update', $matiere) : route('matieres.store') }}" method="POST" class="space-y-6">
    @csrf
    @if(isset($matiere))
        @method('PUT')
    @endif

    <div>
        <label for="nom" class="block text-sm font-medium text-gray-700">Nom de la matière</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom', $matiere->nom ?? '') }}"
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
    </div>

    <div>
        <label for="coefficient" class="block text-sm font-medium text-gray-700">Coefficient</label>
        <input type="number" name="coefficient" id="coefficient" value="{{ old('coefficient', $matiere->coefficient ?? 1) }}"
               min="1"
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
    </div>

    <!-- resources/views/matieres/_form.blade.php -->



<div class="mb-4">
    <label for="enseignant_id" class="block font-medium text-gray-700">Enseignant</label>
    <select name="enseignant_id" id="enseignant_id"
        class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">-- Choisir un enseignant --</option>
        @foreach ($enseignants as $enseignant)
            <option value="{{ $enseignant->id }}"
                {{ old('enseignant_id', $matiere->enseignant_id ?? '') == $enseignant->id ? 'selected' : '' }}>
                {{ $enseignant->nom }} {{ $enseignant->prenom }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="classe_id" class="block font-medium text-gray-700">Classe</label>
    <select name="classe_id" id="classe_id"
        class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">-- Choisir une classe --</option>
        @foreach ($classes as $classe)
            <option value="{{ $classe->id }}"
                {{ old('classe_id', $matiere->classe_id ?? '') == $classe->id ? 'selected' : '' }}>
                {{ $classe->nom }}
            </option>
        @endforeach
    </select>
</div>


    <div class="flex justify-end">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            {{ isset($matiere) ? 'Mettre à jour' : 'Créer' }}
        </button>
    </div>
</form>
