<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Portail Scolaire') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen text-gray-800 font-sans">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-lg border-r border-blue-200 hidden sm:block">
        <div class="p-6 bg-blue-600 text-white text-2xl font-bold flex items-center space-x-2">
            🎓 <span>Portail Scolaire</span>
        </div>

        <nav class="px-4 py-6 space-y-2 text-sm">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-blue-100 transition">
                🏠 <span>Tableau de bord</span>
            </a>

            <a href="{{ route('eleves.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-yellow-100 text-yellow-700 font-medium transition">
                👨‍🎓 <span>Élèves</span>
            </a>

            <a href="{{ route('enseignants.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-green-100 text-green-700 font-medium transition">
                👩‍🏫 <span>Enseignants</span>
            </a>

            <a href="{{ route('classes.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-pink-100 text-pink-700 font-medium transition">
                🏷️ <span>Classes</span>
            </a>

            <a href="{{ route('bulletins.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-orange-100 text-orange-700 font-medium transition">
                📑 <span>Bulletins</span>
            </a>

            <a href="{{ route('notes.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-blue-100 text-blue-700 font-medium transition">
                📋 <span>Notes</span>
            </a>

            <a href="{{ route('niveaux.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-green-100 text-green-700 font-semibold transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h3v7H3v-7zM9 8h3v11H9V8zM15 4h3v15h-3V4z" />
                </svg>
                <span>Niveaux</span>
            </a>

            <a href="{{ route('matieres.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-purple-100 text-purple-700 font-semibold transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-6-6h12" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19a8 8 0 0116 0v-14a8 8 0 00-16 0v14z" />
                </svg>
                <span>Matières</span>
            </a>

            <a href="{{ route('affectations.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-indigo-100 text-indigo-700 font-semibold transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 00-8 0v4H5a2 2 0 00-2 2v5a2 2 0 002 2h14a2 2 0 002-2v-5a2 2 0 00-2-2h-3V7z" />
                </svg>
                <span>Affectations</span>
            </a>

            <a href="{{ route('periodes.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-cyan-100 text-cyan-700 font-medium transition">
                📅 <span>Périodes</span>
            </a>

            <a href="{{ route('annees.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-rose-100 text-rose-700 font-medium transition">
                📆 <span>Années scolaires</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="pt-4">
                @csrf
                <button type="submit" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-red-100 text-red-600 font-medium transition w-full">
                    🔓 <span>Déconnexion</span>
                </button>
            </form>
        </nav>
    </aside>

    {{-- Main content --}}
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="bg-white shadow-md p-5 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-700">@yield('title', 'Dashboard')</h1>
            <div class="text-sm text-gray-600 font-semibold">
                {{ Auth::user()->name ?? 'Admin' }}
            </div>
        </header>

        <!-- Main section -->
        <main class="flex-1 p-6 overflow-y-auto bg-gradient-to-b from-white via-blue-50 to-green-50">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
