@extends('Front.pages.layouts.app')

@section('title', 'Confirm Password')

@section('main')
    <div class="flex justify-center">
        <h2 class="text-xl font-semibold mb-4">Confirm Password</h2>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

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

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password" class="block mt-1 w-full border border-gray-300 rounded-md p-2" type="password" name="password" required autocomplete="current-password">
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
@endsection
