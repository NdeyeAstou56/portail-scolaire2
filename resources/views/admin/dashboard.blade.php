@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-6">
    <div class="bg-white rounded-xl shadow-md p-8">
        <h1 class="text-3xl font-bold text-blue-700 mb-4">Bienvenue, Administrateur 👩‍💼</h1>
        <p class="text-gray-700">Vous avez accès à toute la gestion du système scolaire.</p>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-100 p-4 rounded-xl text-center shadow">
                <h2 class="text-xl font-semibold">Élèves</h2>
                <p class="text-sm text-gray-600">Gestion des inscriptions et bulletins</p>
            </div>
            <div class="bg-green-100 p-4 rounded-xl text-center shadow">
                <h2 class="text-xl font-semibold">Enseignants</h2>
                <p class="text-sm text-gray-600">Gestion des matières & notes</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded-xl text-center shadow">
                <h2 class="text-xl font-semibold">Statistiques</h2>
                <p class="text-sm text-gray-600">Vue globale des performances</p>
            </div>
        </div>
    </div>
</div>
@endsection
