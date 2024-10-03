@extends('Front.pages.layouts.app')

@section('title', 'Login')

@section('main')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="img/img-01.png" alt="IMG">
                </div>

                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf

                    <span class="login100-form-title">
                       Se Connecter
                    </span>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">                            
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

                    <!-- Password -->
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input id="password" class="input100" type="password" name="password" required placeholder="Mot de passe">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Souviens moi') }}</span>
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Se Connecter
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                        Vous avez oublié 
                        </span>
                        <a class="txt2" href="{{ route('password.request') }}">
                        Votre mot de passe?
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
