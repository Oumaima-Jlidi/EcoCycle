@extends('Front.pages.layouts.app')

@section('title', 'Forgot Password')

@section('main')
    <div class="flex justify-center">
        <h2 class="text-xl font-semibold mb-4">Forgot Password</h2>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input id="email" class="block mt-1 w-full border border-gray-300 rounded-md p-2" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
@endsection
