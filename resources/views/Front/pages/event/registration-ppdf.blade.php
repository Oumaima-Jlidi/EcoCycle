<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à l'événement</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .event-details, .user-details {
            margin-bottom: 20px;
        }
        .event-details h2, .user-details h2 {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Confirmation d'inscription à l'événement</h1>
    </div>

    <div class="user-details">
        <h2>Détails du participant</h2>
        <p><strong>Nom:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <div class="event-details">
        <h2>Détails de l'événement</h2>
        <p><strong>Titre:</strong> {{ $event->title }}</p>
        <p><strong>Lieu:</strong> {{ $event->location }}</p>
        <p><strong>Date:</strong> {{ $event->start_date->format('d/m/Y') }}</p>
        <p><strong>Participants maximum:</strong> {{ $event->max_participants }}</p>
    </div>

    <div class="footer">
        <p>Merci pour votre inscription à cet événement. Nous sommes impatients de vous y voir !</p>
    </div>
</body>
</html>
