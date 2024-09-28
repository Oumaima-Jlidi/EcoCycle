@extends('Front.pages.layouts.app')

@section('title')
    @yield('title')
@endsection

@section('main')
    <div class="flex space-x-32 w-full">
        @include('Front.pages.dashboard.sidebar')
        @yield('content')
    </div>
@endsection