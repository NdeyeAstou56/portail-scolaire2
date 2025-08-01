<x-mail::message>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bulletin Disponible pour votre enfant</title>
</head>
<body>
    <p>Bonjour {{ $bulletin->eleve->parent->name ?? 'Parent' }},</p>

    <p>Le bulletin de votre enfant <strong>{{ $bulletin->eleve->user->name }}</strong> pour la période 
    <strong>{{ $bulletin->periode->nom }}</strong> est maintenant disponible.</p>

    <p>Veuillez vous connecter à votre espace parent sur le portail scolaire pour le consulter.</p>

    <p>Merci,<br>L’équipe du Portail Scolaire</p>
</body>
</html>
