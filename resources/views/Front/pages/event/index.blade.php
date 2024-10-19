<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('agenda/css/bootstrap.min.css') }}">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ asset('agenda/css/font-awesome.min.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('agenda/css/swiper.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('agenda/style.css') }}">

</head>
<body>
    <!-- Include navbar or other header sections from Front.frontIndex -->
    @extends('Front.frontIndex')
    
    <!-- Main content section -->
    @section('frontSection')

    <div class="container">
        <!-- Search Form (Make sure it's outside the navbar) -->
        <br/><br/><br/>
        <section>
            <form class="events-search" id="search-form">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <input type="date" id="search-date" placeholder="Date">
                    </div>

                    <div class="col-12 col-md-3">
                        <input type="text" id="search-event" placeholder="Event">
                    </div>

                    <div class="col-12 col-md-3">
                        <input type="text" id="search-location" placeholder="Location">
                    </div>

                    <div class="col-12 col-md-3">
                        <input class="btn gradient-bg" type="button" value="Search Events" id="search-button">
                    </div>
                </div>
            </form>
        </section>
    
    

        <!-- Message No Events -->
        <div id="no-events-message" class="alert alert-warning" style="display: none;">
            Aucun événement trouvé avec les critères de recherche.
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('events.indexFront') }}" method="GET" id="sort-form">
        <!-- Descending (Most Recent) -->
        <button type="submit" name="sort" value="desc" class="btn btn-link p-0" style="border: none; background: none;">
            <i class="fa fa-sort-amount-desc" aria-hidden="true" style="font-size: 24px; color: {{ request('sort') == 'desc' ? '#007bff' : '#6c757d' }};"></i>
        </button>

        <!-- Ascending (Oldest) -->
        <button type="submit" name="sort" value="asc" class="btn btn-link p-0" style="border: none; background: none;">
            <i class="fa fa-sort-amount-asc" aria-hidden="true" style="font-size: 24px; color: {{ request('sort') == 'asc' ? '#007bff' : '#6c757d' }};"></i>
        </button>
    </form>
</div>
<div class="text-right">
            <a href="{{ route('events.createFront') }}" class="btn btn-success mb-3">Add Event</a>
        </div>
        <!-- Event List -->
        <div class="row events-list">
            @foreach($events as $event)
                <div class="col-12 col-lg-6 single-event">
                    <figure class="events-thumbnail">
                        <a href="#">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                        </a>
                    </figure>

                    <div class="event-content-wrap">
                        <header class="entry-header flex justify-content-between">
                            <div>
                            <h2 class="entry-title">
    <a href="{{ route('events.show', $event->id) }}">{{ $event->title }}</a>
</h2>
                                <div class="event-location"><a href="#">{{ $event->location }}</a></div>
                                <div class="event-date">{{ $event->start_date->format('Y-m-d') }}</div> <!-- Format compatible avec l'input date -->
                            </div>
                            <div class="event-cost flex justify-content-center align-items-center">
                               <div> Max Participants: <span>{{ $event->max_participants }}</span><div>
                               <div>Places Restantes: <span>{{ $event->max_participants - $event->participants_count }}</span></div>

                            </div>
                        </header>
                        <br/>
                        <div class="entry-footer">
                        @if(Auth::check())
                    @php
                        $isRegistered = $event->registrations()->where('user_id', Auth::id())->exists();
                        $remainingPlaces = $event->max_participants - $event->participants_count;
                    @endphp

                    @if($event->user_id == Auth::id()) <!-- Vérifie si l'utilisateur est le créateur de l'événement -->
                        <a href="{{ route('events.editfront', $event->id) }}" class="btn btn-warning">Modifier</a>
                    @elseif($isRegistered)
                        <span>Vous êtes inscrit</span>
                        <a href="{{ route('events.exportPdf', $event->id) }}" class="btn btn-primary">reçu pdf</a>
                    @elseif($remainingPlaces <= 0)
                        <span style="color: red;">Aucune place restante</span>
                    @else
                        <form action="{{ route('events.register', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Participer</button>
                        </form>
                    @endif
                @else
                    <span><a href="{{ route('login') }}">Connectez-vous pour participer</a></span>
                @endif
</div><br/>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br><br><br><br><br>

<!-- Add pagination links here -->
<div >
<div class="col-12">
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
                                    <footer class="entry-footer">
                                        <a href="#">Participer</a>
                                    </footer>
                                </div>
                            @endforeach
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
                    event.style.display = 'block'; // Afficher l'événement
                    hasEvent = true; // Un événement a été trouvé
                } else {
                    event.style.display = 'none'; // Masquer l'événement
                }
            });

            // Afficher ou masquer le message "Aucun événement trouvé"
            document.getElementById('no-events-message').style.display = hasEvent ? 'none' : 'block';
        });
    </script>

    @endsection
</body>
</html>
