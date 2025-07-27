@extends('layouts.enseignant')

@section('title', 'Tableau de bord Enseignant')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md border border-blue-100">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <!-- Texte de bienvenue -->
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl font-extrabold text-green-700 mb-2 flex items-center">
                    👨‍🏫 Bienvenue, {{ Auth::user()->name }} !
                </h1>
                <p class="text-gray-600 text-sm">
                    Voici votre tableau de bord enseignant. Gérez vos notes, vos classes et consultez les bulletins des élèves.
                </p>
            </div>

            <!-- Illustration -->
            <div class="w-32 h-32">
                <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Dashboard enseignant" class="w-full h-full object-contain">
            </div>
        </div>

        <!-- Grille des accès rapides -->
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Saisie des notes --}}
            <x-dashboard-card 
                title="Saisir les notes" 
                text="Entrez les résultats des élèves"
                icon="https://cdn-icons-png.flaticon.com/512/2857/2857396.png"
                color="blue"
                :link="route('notes.index')" />

            {{-- Élèves de mes classes --}}
            <x-dashboard-card 
                title="Mes élèves" 
                text="Liste des élèves par classe"
                icon="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                color="green"
                :link="route('eleves.index')" />

            {{-- Bulletins --}}
            <x-dashboard-card 
                title="Bulletins" 
                text="Consulter les bulletins"
                icon="https://cdn-icons-png.flaticon.com/512/709/709790.png"
                color="indigo"
                :link="route('bulletins.index')" />
        </div>
    </div>
@endsection