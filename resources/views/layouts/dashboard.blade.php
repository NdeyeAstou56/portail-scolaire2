<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Portail Scolaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts (optionnel mais recommandé pour un rendu plus doux) -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 text-gray-800 font-sans min-h-screen flex">

    <!-- Barre latérale -->
    <aside class="w-64 bg-white h-screen shadow-lg fixed top-0 left-0 flex flex-col border-r border-blue-100 z-20">
        <div class="p-6 text-2xl font-extrabold text-blue-700 border-b border-gray-200 flex items-center gap-2">
            🎓 Portail Scolaire
        </div>

        <nav class="flex-1 p-4 space-y-3 text-sm font-medium">
            <a href="#" class="flex items-center px-4 py-2 rounded-md hover:bg-blue-100 transition-all">
                🏠 <span class="ml-2">Dashboard</span>
            </a>

            <a href="#" class="flex items-center px-4 py-2 rounded-md hover:bg-green-100 text-green-700 transition-all">
                👤 <span class="ml-2">Profil</span>
            </a>

            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="flex items-center px-4 py-2 rounded-md hover:bg-red-100 text-red-600 transition-all">
                🔓 <span class="ml-2">Déconnexion</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="ml-64 flex-1 p-6 bg-gradient-to-b from-white via-blue-50 to-green-50">
        @yield('content')
    </main>

</body>
</html>
