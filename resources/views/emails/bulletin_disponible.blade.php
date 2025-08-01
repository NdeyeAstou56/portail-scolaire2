<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bulletin Disponible</title>
</head>
<body>
    <p>Bonjour {{ $bulletin->eleve->user->name }},</p>

    <p>Votre bulletin pour la période <strong>{{ $bulletin->periode->nom }}</strong> est maintenant disponible.</p>

    <p>Veuillez vous connecter à votre portail pour le consulter.</p>

    <p>Merci,<br>L’équipe du Portail Scolaire</p>
</body>
</html>
