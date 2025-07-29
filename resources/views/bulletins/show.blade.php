{{-- resources/views/bulletins/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Bulletin - ' . ($bulletin->eleve->user->nom ?? '') . ' ' . ($bulletin->eleve->user->prenom ?? ''))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-4 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- En-tête du bulletin --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            {{-- Header avec gradient --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 sm:px-8 py-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="text-white mb-4 lg:mb-0">
                        <h1 class="text-2xl sm:text-3xl font-bold mb-2">Bulletin de Notes</h1>
                        <p class="text-blue-100 text-sm sm:text-base">
                            {{ $bulletin->eleve->user->nom ?? '' }} {{ $bulletin->eleve->user->prenom ?? '' }} •
                            {{ $bulletin->eleve->classe->nom ?? '' }} •
                            {{ $bulletin->periode->libelle ?? '' }} {{ $bulletin->annee_scolaire->libelle ?? '' }}
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('bulletins.index') }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-xl transition-all duration-200 backdrop-blur-sm text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Retour à la liste
                        </a>
                        @if($bulletin->fichier)
                        <a href="{{ route('bulletins.download', $bulletin->id) }}"
                           class="inline-flex items-center justify-center px-4 py-2 bg-white text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-200 text-sm font-medium shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Télécharger PDF
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8">
                {{-- Informations générales --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    {{-- Informations Élève --}}
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Informations Élève</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nom complet</span>
                                <p class="text-sm font-semibold text-gray-900">{{ $bulletin->eleve->user->nom ?? '' }} {{ $bulletin->eleve->user->prenom ?? '' }}</p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Matricule</span>
                                <p class="text-sm font-semibold text-gray-900">{{ $bulletin->eleve->matricule ?? '' }}</p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Classe</span>
                                <p class="text-sm font-semibold text-gray-900">{{ $bulletin->eleve->classe->nom ?? '' }}</p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Année scolaire</span>
                                <p class="text-sm font-semibold text-gray-900">{{ $bulletin->annee_scolaire->libelle ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Résultats Généraux --}}
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Résultats Généraux</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Moyenne générale</span>
                                <p class="text-2xl font-bold text-green-600">{{ number_format($bulletin->moyenne_generale ?? 0, 2) }}/20</p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Mention</span>
                                <p class="text-sm font-semibold text-gray-900">{{ $bulletin->mention ?? 'Non définie' }}</p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Rang</span>
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $bulletin->rang ?? '-' }}
                                    @if($bulletin->rang && $bulletin->total_eleves)
                                        / {{ $bulletin->total_eleves }}
                                    @endif
                                </p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Période</span>
                                <p class="text-sm font-semibold text-gray-900">{{ $bulletin->periode->libelle ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Détail par matière --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-8 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Détail par Matière
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matière</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enseignant</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coeff.</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Max</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Moyenne</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($detailsNotes as $detail)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-4 py-4">
                                            <div class="flex flex-col">
                                                <div class="text-sm font-medium text-gray-900">{{ $detail['matiere']->nom ?? '' }}</div>
                                                <div class="text-xs text-gray-500">{{ $detail['matiere']->code ?? '' }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="text-sm text-gray-900">
                                                @if($detail['notes']->first() && $detail['notes']->first()->enseignant)
                                                    {{ $detail['notes']->first()->enseignant->user->nom ?? '' }} {{ $detail['notes']->first()->enseignant->user->prenom ?? '' }}
                                                @else
                                                    <span class="text-gray-400">Non assigné</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm font-medium text-gray-900">{{ $detail['coefficient'] ?? 1 }}</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm text-gray-900">{{ $detail['notes']->count() }}</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm text-gray-900">{{ number_format($detail['note_min'] ?? 0, 2) }}</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm text-gray-900">{{ number_format($detail['note_max'] ?? 0, 2) }}</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                @if(($detail['moyenne'] ?? 0) >= 16) bg-green-100 text-green-800
                                                @elseif(($detail['moyenne'] ?? 0) >= 14) bg-blue-100 text-blue-800
                                                @elseif(($detail['moyenne'] ?? 0) >= 12) bg-yellow-100 text-yellow-800
                                                @elseif(($detail['moyenne'] ?? 0) >= 10) bg-indigo-100 text-indigo-800
                                                @else bg-red-100 text-red-800
                                                @endif
                                            ">
                                                {{ number_format($detail['moyenne'] ?? 0, 2) }}/20
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm font-medium text-gray-900">{{ number_format($detail['points'] ?? 0, 2) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Détail des notes par matière --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm mb-8">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Détail des Notes par Matière</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            @foreach($detailsNotes as $detail)
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-sm">
                                    <h4 class="text-md font-semibold text-gray-700 mb-4">{{ $detail['matiere']->nom ?? '' }} (Coeff. {{ $detail['coefficient'] }})</h4>
                                    <ul class="divide-y divide-gray-300 text-sm">
                                        @foreach($detail['notes'] as $note)
                                            <li class="py-2 flex justify-between items-center">
                                                <span>{{ $note->libelle ?? 'Note' }}</span>
                                                <span class="font-semibold text-gray-900">{{ number_format($note->valeur ?? $note->note ?? 0, 2) }}/20</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Appréciations --}}
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Appréciations</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $bulletin->appreciation ?? 'Aucune appréciation pour cette période.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
