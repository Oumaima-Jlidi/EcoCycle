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

  

@php
    // Obtenir les zones de collecte uniques directement dans la vue
    $zones = $collectes->pluck('zone_collecte')->unique();
@endphp

<div class="vine-wrapper">
    <section class="dashboard">
        <div class="container" style="padding-top: 64px;">
            <h4 class="mb-0" data-aos="fade-down" data-aos-easing="linear" style="margin-left: 45px;">
                List of Collectes 
            </h4>

            <!-- Champ de recherche -->
            <div style="margin-top: 20px; margin-left: 45px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher">
            </div>

            <!-- Filtres par zone_collecte avec des cases à cocher -->
            <div style="margin-top: 20px; margin-left: 45px;">
                <h5>Filtrer par Zone Collecte:</h5>
                @foreach ($zones as $zone)
                    <label>
                        <input type="checkbox" class="zone-filter" value="{{ $zone }}"> {{ $zone }}
                    </label>
                @endforeach
            </div>

            <div class="row g-4" id="collectesContainer" style="margin-top: 20px;">
                <!-- Boucle des collectes -->
                @foreach ($collectes as $collecte)
                    <div class="col-lg-4 col-md-6 collecte-item" data-zone="{{ $collecte->zone_collecte }}" data-aos="fade-up" data-aos-easing="linear">
                        <div class="dashboard-card mb-4">
                            <img src="{{ asset('img/collect.PNG') }}" alt="Collect Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="dashboard-body">
                                <!-- Détails de la collecte -->
                                <h5 class="card-title">Nom Collecte: <span class="collecte-nom">{{ $collecte->nom_collecte }}</span></h5>
                                <p class="card-text"><strong>Zone Collecte:</strong> <span class="collecte-zone">{{ $collecte->zone_collecte }}</span></p>
                                <p class="card-text"><strong>Statut:</strong> <span class="collecte-statut">{{ $collecte->statut }}</span></p>
                                <p class="card-text"><strong>Date Collecte:</strong> <span class="collecte-date">{{ $collecte->date_collecte }}</span></p>
                                <p class="card-text"><strong>Quantité Collecte:</strong> <span class="collecte-quantite">{{ $collecte->quantite_collecte }}</span></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const zoneFilters = document.querySelectorAll('.zone-filter');

    // Fonction de filtrage principal
    function filterCollectes() {
        const searchValue = searchInput.value.toLowerCase();
        const selectedZones = Array.from(zoneFilters)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value.toLowerCase());
        
        const collectes = document.querySelectorAll('.collecte-item');

        collectes.forEach(collecte => {
            // Récupérer tous les champs de la collecte
            const nomCollecte = collecte.querySelector('.collecte-nom').textContent.toLowerCase();
            const zoneCollecte = collecte.querySelector('.collecte-zone').textContent.toLowerCase();
            const statutCollecte = collecte.querySelector('.collecte-statut').textContent.toLowerCase();
            const dateCollecte = collecte.querySelector('.collecte-date').textContent.toLowerCase();
            const quantiteCollecte = collecte.querySelector('.collecte-quantite').textContent.toLowerCase();

            // Combiner tous les champs dans une seule chaîne de texte pour simplifier la recherche
            const allText = `${nomCollecte} ${zoneCollecte} ${statutCollecte} ${dateCollecte} ${quantiteCollecte}`;
            
            // Condition pour les zones sélectionnées
            const zoneMatch = selectedZones.length === 0 || selectedZones.includes(zoneCollecte);

            // Affiche ou masque en fonction de la correspondance de la recherche et des zones
            if (allText.includes(searchValue) && zoneMatch) {
                collecte.style.display = 'block';
            } else {
                collecte.style.display = 'none';
            }
        });
    }

    // Écouteurs d'événements pour la recherche et les filtres de zone
    searchInput.addEventListener('input', filterCollectes);
    zoneFilters.forEach(checkbox => checkbox.addEventListener('change', filterCollectes));
</script>


@endsection


</body>
</html>
