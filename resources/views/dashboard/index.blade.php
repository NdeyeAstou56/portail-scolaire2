<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            🏫 Tableau de bord de l'administration
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Cartes de Statistiques -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-bold text-blue-600">📚 Cours</h3>
                    <p class="text-3xl font-semibold mt-2">12</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-bold text-green-600">👨‍🏫 Enseignants</h3>
                    <p class="text-3xl font-semibold mt-2">5</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-bold text-purple-600">👨‍🎓 Élèves</h3>
                    <p class="text-3xl font-semibold mt-2">120</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <h3 class="text-lg font-bold text-red-600">🗓️ Année scolaire</h3>
                    <p class="text-3xl font-semibold mt-2">2024-2025</p>
                </div>
            </div>

            <!-- Section des dernières actions -->
            <div class="bg-white p-6 rounded-lg shadow mt-8">
                <h3 class="text-lg font-bold mb-4">📌 Dernières activités</h3>
                <ul class="list-disc list-inside text-gray-700">
                    <li>Nouvel élève ajouté : <strong>Fatou Diop</strong></li>
                    <li>Note enregistrée pour la période 1</li>
                    <li>Bulletin généré pour la classe de 3eA</li>
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
