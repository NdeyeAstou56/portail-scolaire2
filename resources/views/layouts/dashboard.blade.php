<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Portail Scolaire</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white h-screen shadow-md fixed top-0 left-0 flex flex-col">
        <div class="p-6 text-blue-700 font-bold text-xl border-b">
            Portail Scolaire
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700">Dashboard</a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700">Profil</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="block px-4 py-2 rounded hover:bg-red-100 text-red-600">
                Déconnexion
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="ml-64 w-full p-6">
        @yield('content')
    </main>

</body>
</html>
