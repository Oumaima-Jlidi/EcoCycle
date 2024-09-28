@extends('Front.pages.layouts.app')

@section('title', 'Forgot Password')

@section('main')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="img/img-01.png" alt="IMG"> <!-- Change this to a relevant image if needed -->
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="login100-form validate-form">
                    @csrf

                    <span class="login100-form-title">
                        Mot de passe oublié
                    </span>

                    <div class="mb-4 text-sm text-gray-600">
                        Vous avez oublié votre mot de passe ? Aucun problème. Communiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

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

                    <!-- Email Address -->
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input id="email" class="input100" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Lien de réinitialisation du mot de passe par e-mail
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Vous vous souvenez de votre mot de passe ?
                        </span>
                        <a class="txt2" href="{{ route('login') }}">
                            Se Connecter
                        </a>
                    </div>

                    <div class="text-center p-t-13">
                        <a class="txt2" href="{{ route('register') }}">
                            Créez votre compte
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
