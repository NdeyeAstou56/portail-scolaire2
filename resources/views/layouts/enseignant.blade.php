<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Portail Scolaire') }} - Espace Enseignant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-blue-50 min-h-screen text-gray-800 font-sans">

<div class="flex min-h-screen">

    {{-- Sidebar enseignant --}}
    <aside class="w-64 bg-white shadow-lg border-r border-green-300 hidden sm:block">
        <div class="p-6 bg-green-600 text-white text-2xl font-bold flex items-center space-x-2">
            👩‍🏫 <span>Espace Enseignant</span>
        </div>

        <nav class="px-4 py-6 space-y-2 text-sm">

            <a href="{{ route('enseignant.dashboard') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-green-100 text-green-700 font-semibold transition">
                🏠 <span>Tableau de bord</span>
            </a>

            <a href="{{ route('notes.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-blue-100 text-blue-700 font-medium transition">
                📋 <span>Saisir les Notes</span>
            </a>

            <a href="{{ route('eleves.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-yellow-100 text-yellow-700 font-medium transition">
                👨‍🎓 <span>Mes Élèves</span>
            </a>

            <a href="{{ route('bulletins.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-purple-100 text-purple-700 font-medium transition">
                📑 <span>Bulletins</span>
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
        <header class="bg-white shadow-md p-5 flex justify-between items-center border-b border-green-200">
            <h1 class="text-2xl font-bold text-green-700">@yield('title', 'Dashboard Enseignant')</h1>
            <div class="text-sm text-gray-600 font-semibold">
                {{ Auth::user()->name ?? 'Enseignant' }}
            </div>
        </header>

        <!-- Main section -->
        <main class="flex-1 p-6 overflow-y-auto bg-gradient-to-b from-white via-green-50 to-blue-50">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
