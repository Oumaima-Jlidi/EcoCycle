@extends('Front.pages.layouts.app')

@section('title', 'S’inscrire')

@section('main')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="/img/img-01.png" alt="IMG">
                </div>

                <form method="POST" action="{{ route('register') }}" class="login100-form validate-form" enctype="multipart/form-data">
                    @csrf

                    <span class="login100-form-title">
                        S’inscrire
                    </span>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-4 text-sm font-medium text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Name -->
                    <div class="wrap-input100 validate-input" data-validate="Le nom est requis">
                        <input id="name" class="input100" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Nom">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Email Address -->
                    <div class="wrap-input100 validate-input" data-validate="Un email valide est requis: ex@abc.xyz">
                        <input id="email" class="input100" type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Password -->
                    <div class="wrap-input100 validate-input" data-validate="Le mot de passe est requis">
                        <input id="password" class="input100" type="password" name="password" required autocomplete="new-password" placeholder="Mot de passe">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Confirm Password -->
                    <div class="wrap-input100 validate-input" data-validate="La confirmation du mot de passe est requise">
                        <input id="password_confirmation" class="input100" type="password" name="password_confirmation" required placeholder="Confirmer le mot de passe">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Role Selection -->
                    <div class="wrap-input100">
                        <select id="role" name="role" class="input100" required>
                            <option value="" disabled selected>Choisir votre rôle</option>
                            @foreach ($roles as $role)
                                @if ($role->roleName !== 'admin')
                                    <option value="{{ $role->id }}">{{ $role->roleName }}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Image Upload Field -->
                    <div class="wrap-input100">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image de profil</label>
                        <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*">
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            S’inscrire
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <a class="txt2" href="{{ route('login') }}">
                            Déjà inscrit ?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
