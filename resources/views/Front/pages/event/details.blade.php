<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('agenda/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    @extends('Front.frontIndex')

    @section('frontSection')
    <br/><br/><br/><br/><br/><br/><br/>
    <div class="container">
        <h1>{{ $event->title }}</h1>
        @if(isset($averageRating))
            <h4>Note moyenne : {{ number_format($averageRating, 1) }} / 5</h4>
        @endif
        <p>Date de l'événement : de {{ $event->start_date }} à {{ $event->end_date }}</p>
        <p>Description : {{ $event->description }}</p>

        <!-- Section pour afficher les feedbacks -->
        <h3>Feedbacks pour cet événement :</h3>

        @if($event->feedbacks->count() > 0)
            @foreach($event->feedbacks as $feedback)
                @if($feedback->status == 1) <!-- Only display active feedbacks -->
                    <div class="feedback mb-3">
                        <strong>{{ $feedback->user->name }}</strong>
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $feedback->rating)
                                    <span>&#9733;</span> <!-- étoile remplie -->
                                @else
                                    <span>&#9734;</span> <!-- étoile vide -->
                                @endif
                            @endfor
                        </div>
                        <p class="feedback-comment">{{ $feedback->comment }}</p>

                        @if(Auth::check() && Auth::id() === $feedback->user_id)
                            <!-- Bouton Modifier (Icône) -->
                            <a href="#" class="edit-feedback" data-feedback-id="{{ $feedback->id }}">
                                <i class="fas fa-edit"></i> <!-- Icône de modification -->
                            </a>

                            <!-- Formulaire de suppression -->
                            <form action="{{ route('events.show', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="delete_feedback_id" value="{{ $feedback->id }}">
                                <button type="submit" class="text-danger" style="background: none; border: none; cursor: pointer;">
                                    <i class="fas fa-trash"></i> <!-- Icône de suppression -->
                                </button>
                            </form>

                            <!-- Formulaire de mise à jour -->
                            <form action="{{ route('events.show', $event->id) }}" method="POST" style="display:none;" class="edit-form">
                                @csrf
                                <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                                <textarea name="comment" required>{{ $feedback->comment }}</textarea>
                                <div class="star-rating">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}_{{ $feedback->id }}" name="rating" value="{{ $i }}" {{ $i == $feedback->rating ? 'checked' : '' }} required>
                                        <label for="star{{ $i }}_{{ $feedback->id }}">&#9733;</label>
                                    @endfor
                                </div>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </form>
                        @endif
                    </div>
                @else
                    <!-- Message for the user if their feedback is deactivated -->
                    @if(Auth::check() && Auth::id() === $feedback->user_id)
                        <p class="text-warning">Votre feedback a été masqué par un administrateur.</p>
                    @endif
                @endif
            @endforeach
        @else
            <p style="color: red;">Aucun feedback n'a encore été donné pour cet événement.</p>
        @endif

        <!-- Formulaire pour ajouter un feedback si l'utilisateur est connecté -->
        @if(Auth::check())
            <h3>Laissez votre feedback :</h3>
            <form action="{{ route('events.feedback', $event->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment">Commentaire :</label>
                    <textarea name="comment" id="comment" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="rating">Note :</label>
                    <div class="star-rating">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                            <label for="star{{ $i }}">&#9733;</label>
                        @endfor
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Connectez-vous</a> pour laisser un feedback.</p>
        @endif
    </div>

    <script>
        document.querySelectorAll('.edit-feedback').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const feedbackId = this.getAttribute('data-feedback-id');
                const editForm = document.querySelector(`.edit-form input[name="feedback_id"][value="${feedbackId}"]`).closest('.edit-form');
                editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>

    <style>
        .star-rating {
            direction: rtl;
            display: inline-flex;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
        }
        .star-rating input:checked ~ label {
            color: gold;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }
        .edit-form {
            margin-top: 10px;
        }
    </style>
@endsection
