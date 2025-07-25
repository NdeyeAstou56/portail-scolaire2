<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">#</th>
            <th class="border px-4 py-2">Nom</th>
            <th class="border px-4 py-2">Email</th>
            <th class="border px-4 py-2">Rôle</th>
            <th class="border px-4 py-2">Identifiant</th> <!-- Ajouté -->
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($utilisateurs as $utilisateur)
            <tr>
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $utilisateur->name }}</td>
                <td class="border px-4 py-2">{{ $utilisateur->email }}</td>
                <td class="border px-4 py-2">{{ $utilisateur->role }}</td>
                <td class="border px-4 py-2">{{ $utilisateur->identifiant }}</td> <!-- Ajouté -->
                <td class="border px-4 py-2">
                    <!-- Actions : modifier, supprimer -->
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
