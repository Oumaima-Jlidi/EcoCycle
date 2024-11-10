<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('agenda/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('agenda/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('agenda/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('agenda/style.css') }}">
</head>
<body>
    @extends('Front.frontIndex')
    @section('frontSection')

    <div class="container">
        <br/><br/><br/>
        <section>
            <form class="events-search" id="search-form">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="date" id="search-date" placeholder="Date ">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" id="search-event" placeholder="Nom d'évenements">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" id="search-location" placeholder="Emplacement">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input class="btn gradient-bg" type="button" value="Search Events" id="search-button">
                    </div>
                </div>
            </form>
        </section>

        <div id="no-events-message" class="alert alert-warning" style="display: none;">
            Aucun événement trouvé avec les critères de recherche.
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="{{ route('events.indexFront') }}" method="GET" id="sort-form">
                <button type="submit" name="sort" value="desc" class="btn btn-link p-0" style="border: none; background: none;">
                    <i class="fa fa-sort-amount-desc" aria-hidden="true" style="font-size: 24px; color: {{ request('sort') == 'desc' ? '#007bff' : '#6c757d' }};"></i>
                </button>
                <button type="submit" name="sort" value="asc" class="btn btn-link p-0" style="border: none; background: none;">
                    <i class="fa fa-sort-amount-asc" aria-hidden="true" style="font-size: 24px; color: {{ request('sort') == 'asc' ? '#007bff' : '#6c757d' }};"></i>
                </button>
            </form>
        </div>

        <div class="text-right">
            <a href="{{ route('events.createFront') }}" class="btn btn-success mb-3">Add Event</a>
        </div>

        <div class="row" id="events-list">
            @foreach($events as $event)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <figure class="events-thumbnail">
                            <a href="{{ route('events.show', $event->id) }}">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                            </a>
                        </figure>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('events.show', $event->id) }}">{{ $event->title }}</a>
                            </h5>
                            <p class="card-text">
                                <strong>Emplacement:</strong> {{ $event->location }}<br>
                                <strong>Date:</strong> {{ $event->start_date->format('Y-m-d') }}<br>
                                <strong>Max Participants:</strong> {{ $event->max_participants }}<br>
                                <strong>Places Restantes:</strong> {{ $event->max_participants - $event->participants_count }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if(Auth::check())
                                    @php
                                        $isRegistered = $event->registrations()->where('user_id', Auth::id())->exists();
                                        $remainingPlaces = $event->max_participants - $event->participants_count;
                                        $isEventFinished = $event->end_date < now();
                                    @endphp
                                    @if($event->user_id == Auth::id())
                                        <a href="{{ route('events.editfront', $event->id) }}" class="btn btn-warning">Modifier</a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    @elseif($isRegistered)
                                        <span>Vous êtes inscrit</span>
                                        <a href="{{ route('events.exportPdf', $event->id) }}" class="btn btn-primary">reçu pdf</a>
                                    @elseif($remainingPlaces <= 0)
                                        <span style="color: red;">Aucune place restante</span>
                                    @elseif($isEventFinished)
                                        <span style="color: gray;">Événement terminé</span>
                                    @else
                                        <form action="{{ route('events.register', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Participer</button>
                                        </form>
                                    @endif
                                @else
                                    <span><a href="{{ route('login') }}">Connectez-vous pour participer</a></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination d-flex justify-content-center mt-5">
        @if ($events->onFirstPage())
            <span class="disabled rounded">&laquo;</span>
        @else
            <a href="{{ $events->previousPageUrl() . '&sort=' . request('sort') }}" class="rounded">&laquo;</a>
        @endif

        @for ($i = 1; $i <= $events->lastPage(); $i++)
            @if ($i == $events->currentPage())
                <span class="active rounded">{{ $i }}</span>
            @else
                <a href="{{ $events->url($i) . '&sort=' . request('sort') }}" class="rounded">{{ $i }}</a>
            @endif
        @endfor

        @if ($events->hasMorePages())
            <a href="{{ $events->nextPageUrl() . '&sort=' . request('sort') }}" class="rounded">&raquo;</a>
        @else
            <span class="disabled rounded">&raquo;</span>
        @endif       
     </div>
</div>
    <!-- Upcoming Events Section -->
    <div class="upcoming-events-outer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="upcoming-events">
                    <div class="upcoming-events-header">
                        <h4>Upcoming Events</h4>
                    </div>
                    <div class="upcoming-events-list">
                        @if($upcomingEvents->isEmpty())
                            <div class="alert alert-warning">
                                Aucun événement prévu dans les 7 jours suivants.
                            </div>
                        @else
                            @foreach($upcomingEvents as $upcomingEvent)
                                <div class="upcoming-event-wrap flex flex-wrap justify-content-between align-items-center">
                                    <figure class="events-thumbnail">
                                        <a href="#"><img src="{{ asset('storage/' . $upcomingEvent->image) }}" alt="{{ $upcomingEvent->title }}"></a>
                                    </figure>
                                    <div class="entry-meta">
                                        <div class="event-date">{{ $upcomingEvent->start_date->format('M') }}<span>{{ $upcomingEvent->start_date->format('d') }}</span></div>
                                    </div>
                                    <header class="entry-header">
                                        <h3 class="entry-title"><a href="#">{{ $upcomingEvent->title }}</a></h3>
                                        <div class="event-date-time">{{ $upcomingEvent->start_date->format('M d, Y @ h:i A') }}</div>
                                        <div class="event-description">{{ $upcomingEvent->description }}</div>
                                    </header>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Back to Top Button -->
    <div class="back-to-top flex justify-content-center align-items-center">
        <span><svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg></span>
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('agenda/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('agenda/js/masonry.pkgd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('agenda/js/jquery.collapsible.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('agenda/js/swiper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('agenda/js/jquery.countdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('agenda/js/circle-progress.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('agenda/js/jquery.countTo.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('agenda/js/custom.js') }}"></script>

    <!-- Script pour le filtrage -->
    <script>
        document.getElementById('search-button').addEventListener('click', function() {
            // Obtenez les valeurs des champs de recherche
            const date = document.getElementById('search-date').value;
            const eventName = document.getElementById('search-event').value.toLowerCase();
            const location = document.getElementById('search-location').value.toLowerCase();

            // Obtenez tous les événements
            const events = document.querySelectorAll('.single-event');
            let hasEvent = false; // Variable pour suivre si un événement est trouvé

            // Parcourez chaque événement et appliquez les filtres
            events.forEach(event => {
                const eventTitle = event.querySelector('.entry-title').textContent.toLowerCase();
                const eventLocation = event.querySelector('.event-location').textContent.toLowerCase();
                const eventDate = event.querySelector('.event-date').textContent;

                // Vérifiez si l'événement correspond aux critères
                const matchesDate = date ? eventDate.includes(date) : true;
                const matchesEventName = eventTitle.includes(eventName);
                const matchesLocation = eventLocation.includes(location);

                // Affichez ou masquez l'événement en fonction des critères
                if (matchesDate && matchesEventName && matchesLocation) {
                    event.style.display = 'flex'; // Afficher l'événement
                    hasEvent = true; // Un événement a été trouvé
                } else {
                    event.style.display = 'none'; // Masquer l'événement
                }
            });

            // Afficher ou masquer le message "Aucun événement trouvé"
            document.getElementById('no-events-message').style.display = hasEvent ? 'none' : 'block';
        });
    </script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-button').on('click', function() {
            const date = $('#search-date').val();
            const event = $('#search-event').val();
            const location = $('#search-location').val();

            $.ajax({
                url: '{{ route('events.search') }}',
                method: 'GET',
                data: {
                    date: date,
                    event: event,
                    location: location
                },
                success: function(response) {
                    $('#events-list').empty(); // Vider la liste des événements

                    if (response.length === 0) {
                        $('#no-events-message').show();
                    } else {
                        $('#no-events-message').hide();
                        response.forEach(function(event) {
                            $('#events-list').append(`
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        <figure class="events-thumbnail">
                                            <a href="/events/${event.id}">
                                                <img src="/storage/${event.image}" alt="${event.title}" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                                            </a>
                                        </figure>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="/events/${event.id}">${event.title}</a>
                                            </h5>
                                            <p class="card-text">
                                                <strong>Emplacement:</strong> ${event.location}<br>
                                                <strong>Date:</strong> ${event.start_date}<br>
                                                <strong>Max Participants:</strong> ${event.max_participants}<br>
                                                <strong>Places Restantes:</strong> ${event.max_participants - event.participants_count}
                                            </p>
                                            <!-- Ajouter les boutons d'action ici -->
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    }
                },
                error: function() {
                    console.error('Une erreur s\'est produite.');
                }
            });
        });
    });
</script>
 

    @endsection
</body>
</html>
