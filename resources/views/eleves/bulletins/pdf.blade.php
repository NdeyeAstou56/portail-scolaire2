<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bulletin PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Bulletin de Notes</h2>
    <p><strong>Nom :</strong> {{ $bulletin->eleve->user->nom }} {{ $bulletin->eleve->user->prenom }}</p>
    <p><strong>Matricule :</strong> {{ $bulletin->eleve->matricule }}</p>
    <p><strong>Année scolaire :</strong> {{ $bulletin->annee_scolaire->libelle }}</p>
    <p><strong>Moyenne générale :</strong> {{ number_format($bulletin->moyenne_generale, 2) }}/20</p>

    <h4>Notes</h4>
    <table>
        <thead>
            <tr>
                <th>Matière</th>
                <th>Note</th>
                <th>Libellé</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bulletin->notes as $note)
                <tr>
                    <td>{{ $note->matiere->nom }}</td>
                    <td>{{ $note->valeur }}</td>
                    <td>{{ $note->libelle }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
