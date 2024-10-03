<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Change Password Page">
    <meta name="keywords" content="bootstrap 5, password, change">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>

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
                <h4 class="mb-4">Changer le mot de passe</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                @error('new_password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @endsection

</body>

</html>
