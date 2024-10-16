<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Forum & Community Discussions HTML Template">
    <meta name="keywords" content="bootstrap 5, forum, community, support, social, q&a, mobile, html">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ➕ Add Post</title>

    <!-- Inclure les fichiers CSS avec Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="switcher switcher-show" id="theme-switcher" style="margin-bottom: 55px; margin-right: -8px;">
        <i id="switcher-icon" class="bi bi-moon"></i>
    </div>
    @extends('Front.frontIndex')
    @section('frontSection')

    <div class="vine-wrapper">
        <section class="vine-main">
            <div class="container" style="padding-top: 156px;">
                <div class="row">
                    <div class="col-lg-12 pe-lg-7">

                        <div class="filter-2 d-flex justify-content-between">
                            <div class="col-xl-5 mt-3 mb-3" style="margin-left: 44px;">
                                <div class="nav flex-nowrap align-items-center">
                                    <div class="search-form nav-item w-100">
                                        <form>
                                            <input class="border-0" type="search" placeholder="Search" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <ul>
                                <a class="btn btn me-3" style="background-color: #81c408;" href="{{ route('posts.add') }}">Add Subject</a>
                            </ul>
                        </div>
                        <!--/Filter-2-->

                        <div class="discussions">
                            <!-- Loop through the subjects and display them -->
                            @foreach($posts as $sujet)
                                <div class="post-box-2" data-aos="fade-up" data-aos-easing="linear">
                                    <div class="user-box-img">
                                        <a href="#">
                                        <img src="{{  $sujet->user->image ? asset('storage/' .  $sujet->user->image) : asset('default-profile.png') }}" 
                                        alt="user" class="img-fluid">
                                        </a>
                                        <span class="title-box-name d-block d-md-none d-lg-none">
                                            <a href="#">{{ $sujet->user->name }}</a>
                                        </span>
                                    </div>

                                    <div class="title-box">
                                        <h6>
                                            <a href="{{ route('show.index', $sujet->id) }}">
                                                {{ $sujet->content }} @if ($sujet->statut == 'non_resolu')
    🔓
@else
    🔒
@endif
                                            </a>
                                        </h6>
                                        <div class="d-flex align-items-center flex-wrap">
                                            <span class="title-box-name d-none d-md-block d-lg-block">
                                                <a href="#">{{ $sujet->user->name }}</a>
                                            </span>
                                            <span class="title-box-text">
                                                <i class="bi bi-clock-history"></i> {{ $sujet->created_at->diffForHumans() }}
                                            </span>
                                            <span class="title-box-text">
                                                <i class="bi bi-chat-dots"></i> {{ $sujet->replays->count() }} replies
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div><!--/Discussions-->
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection
</body>

</html>
