@extends('Front.pages.layouts.app') 
@section('title', 'Reset Password')

@section('main')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
            <img src="{{ asset('img/img-01.png') }}" alt="IMG">
            </div>

                <form method="POST" action="{{ route('password.update') }}" class="login100-form validate-form">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <span class="login100-form-title">
                        {{ __('Réinitialiser le mot de passe') }}
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

                    <!-- Email Address -->
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input id="email" class="input100" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus placeholder="Email">
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

                    <!-- Confirm Password -->
                    <div class="wrap-input100 validate-input" data-validate="Password confirmation is required">
                        <input id="password_confirmation" class="input100" type="password" name="password_confirmation" required placeholder="Confirmer le mot de passe">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            {{ __('Réinitialiser mot de passe') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
