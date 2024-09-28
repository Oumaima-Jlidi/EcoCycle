@extends('Front.pages.layouts.app')

@section('title', 'Reset Password')

@section('main')
    <div class="flex justify-center">
        <h2 class="text-xl font-semibold mb-4">Reset Password</h2>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
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

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input id="email" class="block mt-1 w-full border border-gray-300 rounded-md p-2" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password" class="block mt-1 w-full border border-gray-300 rounded-md p-2" type="password" name="password" required>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" class="block mt-1 w-full border border-gray-300 rounded-md p-2" type="password" name="password_confirmation" required>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
@endsection
