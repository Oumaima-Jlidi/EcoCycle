<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Edit Profile Page">
    <meta name="keywords" content="bootstrap 5, profile, edit">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

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
                <h4 class="mb-4">Modifier le profil</h4>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image de Profil</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <small class="form-text text-muted">Laissez vide si vous ne voulez pas changer l'image.</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @endsection
</body>

</html>
