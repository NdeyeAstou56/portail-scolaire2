@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md border border-blue-100">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <!-- Texte de bienvenue -->
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl font-extrabold text-blue-700 mb-2 flex items-center">
                    👋 Bienvenue, {{ Auth::user()->name }} !
                </h1>
                <p class="text-gray-600 text-sm">
                    Voici votre tableau de bord administratif. Accédez rapidement à toutes les sections du système scolaire.
                </p>
            </div>

            <!-- Illustration -->
            <div class="w-32 h-32">
                <img src="https://cdn-icons-png.flaticon.com/512/201/201623.png" alt="Admin dashboard" class="w-full h-full object-contain">
            </div>
        </div>

        <!-- Grille des accès rapides -->
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- Élèves --}}
            <x-dashboard-card 
                title="Élèves" 
                text="Gérez les fiches élèves"
                icon="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                color="blue"
                :link="route('eleves.index')" />

            {{-- Enseignants --}}
            <x-dashboard-card 
                title="Enseignants" 
                text="Suivi des professeurs"
                icon="https://cdn-icons-png.flaticon.com/512/4140/4140048.png"
                color="green"
                :link="route('enseignants.index')" />

            {{-- Classes --}}
            <x-dashboard-card 
                title="Classes" 
                text="Organisation des classes"
                icon="https://cdn-icons-png.flaticon.com/512/1822/1822899.png"
                color="purple"
                :link="route('classes.index')" />

            {{-- Niveaux --}}
            <x-dashboard-card 
                title="Niveaux" 
                text="Structure pédagogique"
                icon="https://cdn-icons-png.flaticon.com/512/3256/3256013.png"
                color="indigo"
                :link="route('niveaux.index')" />

            {{-- Matières --}}
            <x-dashboard-card 
                title="Matières" 
                text="Catalogue des cours"
                icon="https://cdn-icons-png.flaticon.com/512/3132/3132693.png"
                color="yellow"
                :link="route('matieres.index')" />

            {{-- Notes --}}
            <x-dashboard-card 
                title="Notes" 
                text="Résultats scolaires"
                icon="https://cdn-icons-png.flaticon.com/512/2857/2857396.png"
                color="rose"
                :link="route('notes.index')" />

            {{-- Affectations --}}
            <x-dashboard-card 
                title="Affectations" 
                text="Répartition enseignants/matières"
                icon="https://cdn-icons-png.flaticon.com/512/3135/3135768.png"
                color="cyan"
                :link="route('affectations.index')" />

            {{-- Périodes --}}
            <x-dashboard-card 
                title="Périodes" 
                text="Trimestres et évaluations"
                icon="https://cdn-icons-png.flaticon.com/512/1029/1029183.png"
                color="orange"
                :link="route('periodes.index')" />

            {{-- Années scolaires --}}
            <x-dashboard-card 
                title="Années scolaires" 
                text="Historique scolaire"
                icon="https://cdn-icons-png.flaticon.com/512/2838/2838912.png"
                color="teal"
                :link="route('annees.index')" />

        </div>
    </div>
@endsection
