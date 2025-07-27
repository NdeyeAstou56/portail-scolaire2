<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mes Bulletins</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            margin: 2rem;
            color: #333;
        }
        h1 {
            color: #5a2d82;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 0.5rem 1rem;
            text-align: left;
        }
        th {
            background-color: #e3d7f4;
            color: #5a2d82;
        }
        tr:hover {
            background-color: #f0e9fb;
        }
        a.download-link {
            color: #5a2d82;
            text-decoration: none;
            font-weight: bold;
        }
        a.download-link:hover {
            text-decoration: underline;
        }
        .no-bulletin {
            margin-top: 1rem;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Mes Bulletins Scolaires</h1>

    @if ($bulletins->isEmpty())
        <p class="no-bulletin">Aucun bulletin disponible pour le moment.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Année scolaire</th>
                    <th>Période</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bulletins as $bulletin)
                <tr>
                    <td>{{ $bulletin->annee }}</td>
                    <td>{{ ucfirst($bulletin->periode) }}</td>
                    <td>
                        <a href="{{ route('eleve.bulletins.download', $bulletin) }}" class="download-link" target="_blank" rel="noopener noreferrer">
                            Télécharger PDF
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
