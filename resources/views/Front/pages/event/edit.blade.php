<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('agenda/css/bootstrap.min.css') }}">
</head>
<body>
    @extends('Front.frontIndex')

    @section('frontSection')

    <div class="container">
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <h2>Modifier l'Événement</h2>
        <form action="{{ route('events.updatefront', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titre de l'Événement</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $event->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Date de Début</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">Date de Fin</label>
                <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $event->end_date->format('Y-m-d\TH:i')) }}" required>
            </div>
            <div class="form-group">
                <label for="location">Emplacement</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $event->location) }}" required>
            </div>
            <div class="form-group">
                <label for="max_participants">Nombre Max de Participants</label>
                <input type="number" class="form-control" id="max_participants" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}" required min="1">
            </div>
            <div class="form-group">
                <label for="image">Image de l'Événement</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                @if ($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" style="width: 100px; height: auto;">
                @endif
            </div>
            <button type="submit" class="btn btn-success">Mettre à Jour</button>
        </form>
    </div>

    @endsection

    <script src="{{ asset('agenda/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
