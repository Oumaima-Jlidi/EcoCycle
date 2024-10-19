<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation d'inscription à l'événement</title>
</head>
<body>
    <h1>Inscription réussie!</h1>
    <p>Cher participant,</p>
    <p>Nous vous confirmons votre inscription à l'événement <strong>{{ $event->title }}</strong>.</p>
    <p>Date : {{ $event->start_date->format('d/m/Y H:i') }}</p>
    <p>Lieu : {{ $event->location }}</p>
    <p>Merci de votre participation!</p>
</body>
</html>
