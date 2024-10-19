<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Forum & Community Discussions HTML Template">
    <meta name="keywords" content="bootstrap 5, forum, community, support, social, q&a, mobile, html">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Profile </title>

    <!-- Inclure les fichiers CSS avec Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="switcher switcher-show" id="theme-switcher" style="margin-bottom: 55px; margin-right: -8px;">
        <i id="switcher-icon" class="bi bi-moon"></i>
    </div>

    @extends('Front.pages.profileuser.app')
    @section('content')

    <div class="vine-wrapper">
        <section class="dashboard">
            <div class="container" style="padding-top: 64px;">
                <div class="row">
                   
                <div class="col-sm-12 col-lg-3 mb-5">
                        @include('TemplateForum.Layouts.Menu')
                    </div>
                    <div class="col-9 col-lg-9">
                        <h4 class="mb-4" data-aos="fade-down" data-aos-easing="linear">Mes informations</h4>

                        <div class="card shadow-sm">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Profile</h4>

                                <!-- Bouton paramètres avec une liste déroulante -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-gear"></i> Paramétres
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('profile.edit', $user->id) }}">Modifier le profil</a>
                                    <li><a class="dropdown-item" href="{{ route('password.change') }}">Changer le mot de passe</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <!-- Affichage de la photo de profil -->
                                    <div class="col-md-4 text-center">
                                        <!-- Agrandir l'image de profil ici -->
                                        <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('default-profile.png') }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 250px; height: 250px;">
                                    </div>

                                    <!-- Informations du profil -->
                                    <div class="col-md-8">
                                        <h5>{{ $user->name }}</h5>
                                        <p class="text-muted">Email: {{ $user->email }}</p>
                                        <p class="text-muted">Rôle : {{ $user->role->roleName }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    @endsection
</body>

</html>
