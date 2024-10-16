<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Forum & Community Discussions HTML Template">
    <meta name="keywords" content="bootstrap 5, forum, community, support, social, q&a, mobile, html">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Our collects</title>

    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>

<body>
<div class="switcher switcher-show" id="theme-switcher" style="margin-bottom: 55px; margin-right: -8px;">
    <i id="switcher-icon" class="bi bi-moon"></i>
</div>

@extends('Front.frontIndex')
@section('frontSection')

  

<div class="vine-wrapper">
    <section class="dashboard">
        <div class="container" style="padding-top: 64px;">
            <h4 class="mb-0" data-aos="fade-down" data-aos-easing="linear" style="margin-left: 45px;">
               List of Collectes
            </h4>

            <div class="row g-4" style="margin-top: 20px;">
                <!-- Loop through collectes -->
                @foreach ($collectes as $collecte)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-easing="linear">
                        <div class="dashboard-card mb-4">
                            <img src="{{ asset('img/collect.PNG') }}" alt="Collect Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="dashboard-body">
                                <!-- Collecte details -->
                                <h5 class="card-title">Nom Collecte: {{ $collecte->nom_collecte }}</h5>
                                <p class="card-text"><strong>Zone Collecte:</strong> {{ $collecte->zone_collecte }}</p>
                                <p class="card-text"><strong>Statut:</strong> {{ $collecte->statut }}</p>
                                <p class="card-text"><strong>Date Collecte:</strong> {{ $collecte->date_collecte }}</p>
                                <p class="card-text"><strong>Quantité Collecte:</strong> {{ $collecte->quantite_collecte }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>


@endsection


</body>
</html>
