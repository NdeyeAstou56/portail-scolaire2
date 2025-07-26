@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white shadow-md rounded p-6">
    <h2 class="text-2xl font-semibold mb-6 text-center text-gray-700">Modifier l'Année Scolaire</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('annees.update', $annee->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Libellé -->
        <div>
            <label for="libelle" class="block text-sm font-medium text-gray-700">Libellé</label>
            <input type="text" name="libelle" id="libelle" value="{{ old('libelle', $annee->libelle) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <!-- Active -->
        <div class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" id="active" value="1"
                   class="form-checkbox h-5 w-5 text-indigo-600"
                   {{ old('active', $annee->active) ? 'checked' : '' }}>
            <label for="active" class="ml-2 block text-sm text-gray-700">Année Active</label>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
