<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bulletin de Notes - {{ $bulletin->eleve->user->name ?? 'Élève' }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background: #f9fafb;
            color: #1f2937;
            margin: 20px;
        }
        h1 {
            text-align: center;
            background: linear-gradient(90deg, #2563eb, #4f46e5);
            color: white;
            padding: 15px 0;
            border-radius: 8px;
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 24px;
        }
        .header-info {
            background: #ffffff;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 30px;
            box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
            font-size: 14px;
        }
        .header-info p {
            margin: 6px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
            font-size: 13px;
        }
        th, td {
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background: #e0e7ff;
            color: #1e40af;
            font-weight: 600;
        }
        tbody tr:hover {
            background: #f3f4f6;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            background-color: #10b981;
        }
        .badge-mention-tres-bien {
            background-color: #059669;
        }
        .section-title {
            font-weight: 700;
            font-size: 18px;
            margin: 25px 0 12px 0;
            color: #374151;
            border-bottom: 2px solid #e0e7ff;
            padding-bottom: 5px;
        }
        .appreciation {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
            font-size: 14px;
            color: #374151;
            white-space: pre-line;
        }
    </style>
</head>
<body>

<h1>Bulletin de Notes</h1>

<div class="header-info">
    <p><strong>Élève :</strong> {{ $bulletin->eleve->user->name ?? 'N/A' }}</p>
    <p><strong>Classe :</strong> {{ $bulletin->eleve->classe->nom ?? 'N/A' }}</p>
    <p><strong>Période :</strong> {{ $bulletin->periode->libelle ?? 'N/A' }}</p>
    <p><strong>Année scolaire :</strong> {{ $bulletin->annee_scolaire->libelle ?? 'N/A' }}</p>
    <p><strong>Moyenne générale :</strong> {{ number_format($bulletin->moyenne ?? 0, 2) }}/20</p>
    <p><strong>Mention :</strong> 
        @if($bulletin->mention)
            <span class="badge badge-mention-tres-bien">{{ $bulletin->mention }}</span>
        @else
            Non définie
        @endif
    </p>
    <p><strong>Rang :</strong> {{ $bulletin->rang ?? '-' }}</p>
</div>

<div class="section-title">Détail par Matière</div>
<table>
    <thead>
        <tr>
            <th>Matière</th>
            <th>Enseignant</th>
            <th>Coefficient</th>
            <th>Notes</th>
            <th>Min</th>
            <th>Max</th>
            <th>Moyenne</th>
            <th>Points</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detailsNotes as $detail)
            <tr>
                <td>{{ $detail['matiere']->nom ?? '' }}</td>
                <td>
                    @if($detail['notes']->first() && $detail['notes']->first()->enseignant)
                        {{ $detail['notes']->first()->enseignant->user->nom ?? '' }} {{ $detail['notes']->first()->enseignant->user->prenom ?? '' }}
                    @else
                        Non assigné
                    @endif
                </td>
                <td>{{ $detail['coefficient'] ?? 1 }}</td>
                <td>
                    @foreach($detail['notes'] as $note)
                        {{ number_format($note->valeur ?? $note->note ?? 0, 2) }}/20<br>
                    @endforeach
                </td>
                <td>{{ number_format($detail['note_min'] ?? 0, 2) }}</td>
                <td>{{ number_format($detail['note_max'] ?? 0, 2) }}</td>
                <td>{{ number_format($detail['moyenne'] ?? 0, 2) }}</td>
                <td>{{ number_format($detail['points'] ?? 0, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="section-title">Appréciations</div>
<div class="appreciation">
    {{ $bulletin->appreciation ?? 'Aucune appréciation pour cette période.' }}
</div>

</body>
</html>
