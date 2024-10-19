<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rappel de l'événement</title>
</head>
<body>
    <h1>Rappel de l'événement!</h1>
    <p>Cher participant,</p>
    <p>Nous vous rappelons que l'événement <strong>{{ $event->title }}</strong> aura lieu aujourd'hui.</p>
    <p>Date : {{ $event->start_date->format('d/m/Y H:i') }}</p>
    <p>Lieu : {{ $event->location }}</p>
    <p>Merci de votre participation!</p>
</body>
</html>
