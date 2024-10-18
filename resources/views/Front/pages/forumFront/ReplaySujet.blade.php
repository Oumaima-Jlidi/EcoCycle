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


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="switcher switcher-show" id="theme-switcher" style="
    margin-bottom: 55px; margin-right: -8px;">
        <i id="switcher-icon" class="bi bi-moon"></i>
    </div>
    @extends('Front.frontIndex')
    @section('frontSection')



    <div class="vine-wrapper">
        <div class="vine-header">
            <div class="breadcrumb-cover">
                <div class="container">
                    <div class="row px-3">
                        <div class="col-lg-12" data-aos="fade-down" data-aos-easing="linear">
                            <h2 class="mb-2">{{ $sujet->content }} @if ($sujet->statut == 'non_resolu')
                                🔓
                                @else
                                🔒
                                @endif</h2>
                            <ul class="breadcrumbs">
                                <li><a href="{{ route('forum.index') }}"><span class="bi bi-chat-left-dots me-1"></span>Forum</a></li>
                                <li>{{ $sujet->content }} @if ($sujet->statut == 'non_resolu')
                                    🔓
                                    @else
                                    🔒
                                    @endif</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="vine-main">
            <div class="container">
                <div class="row">

                    <div class="col-lg-11 ps-lg-5">

                        <div class="discussions">

                            <div class="post-box d-flex" data-aos="fade-up" data-aos-easing="linear">
                                <div class="card">
                                    <div class="card-header card-header-action" style="margin-left: 12px;">
                                        <div class="media align-items-center">
                                            <div class="media-head me-2">
                                                <div class="avatar">
                                                    <a href="#">
                                                        <img class="rounded-circle" src="{{ $sujet->user->image ? asset('storage/' . $sujet->user->image) : asset('default-profile.png') }}" alt="User">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div><a href="#">{{ $sujet->user->name }}</a> <i class="bi bi-patch-check-fill color-11"></i></div>
                                                <div class="fs-7"><span> {{ $sujet->created_at->diffForHumans() }}</span></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <h3>
                                            <a href="#">{{ $sujet->content }} @if ($sujet->statut == 'non_resolu')
                                                🔓
                                                @else
                                                🔒
                                                @endif</a>
                                        </h3>
                                        <p>{!! $sujet->description !!}
                                        </p>


                                    </div>

                                    <div class="card-footer" style="margin-left: 10px;margin-right: 10px;">

                                        <div class="post-stats">
                                            <div class="post-item">
                                                <form action="{{ route('like', ['likeableId' => $sujet->id, 'likeableType' => 'sujet']) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="type" value="like">
                                                    <button type="submit" class="btn btn-link p-0 text-decoration-none">
                                                        ❤️ Like ({{ $sujet->likes->where('type', 'Like')->count() }})
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="post-item">
                                                <form action="{{ route('like', ['likeableId' => $sujet->id, 'likeableType' => 'sujet']) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="type" value="dislike">
                                                    <button type="submit" class="btn btn-link p-0 text-decoration-none">
                                                        💔 Dislike ({{ $sujet->likes->where('type', 'dislike')->count() }})
                                                    </button>
                                                </form>
                                            </div>


                                        </div>

                                    </div>

                                    <h5 class="my-4" style="margin-left: 10px;">Comments ({{ $sujet->replays->count() }})</h5>
                                    <div class="comments-5">
                                        @foreach($sujet->replays as $replay)
                                        <div class="d-flex align-items-start mb-3" data-aos="fade-up" data-aos-easing="linear" style="margin-left: 13px;">
                                            <div class="avatar avatar-sm status-online me-2">
                                                <img class="rounded-circle" src="{{ $replay->user->image ? asset('storage/' . $replay->user->image) : asset('default-profile.png') }}" alt="User">
                                            </div>
                                            <div class="flex-1">
                                                <div class="align-items-center">
                                                    <a class="fw-bold mb-0" href="javascript:void(0)">{{ $replay->user->name }}</a>
                                                </div>
                                                <p class="mb-0">{!! $replay->content !!}</p>
                                                <div class="post-links d-flex mt-1">

                                                    <form action="{{ route('like', ['likeableId' => $replay->id, 'likeableType' => 'reply']) }}" method="POST" style="margin-right: 15px;">
                                                        @csrf
                                                        <input type="hidden" name="type" value="like">
                                                        <button type="submit" class="btn btn-link p-0 text-decoration-none">
                                                            ❤️ Like ({{ $replay->likes->where('type', 'like')->count() }})
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('like', ['likeableId' => $replay->id, 'likeableType' => 'reply']) }}" method="POST" style="margin-right: 15px;">
                                                        @csrf
                                                        <input type="hidden" name="type" value="dislike">
                                                        <button type="submit" class="btn btn-link p-0 text-decoration-none">
                                                            💔 Dislike ({{ $replay->likes->where('type', 'dislike')->count() }})
                                                        </button>
                                                    </form> <a href="#" class="p-0 me-3"><span class="bi bi-reply-all me-1"></span> Reply</a>

                                                    <p class="p-0 me-2"><span class="bi bi-clock-history me-1"></span>{{ $replay->created_at->diffForHumans() }}</p>

                                                </div>

                                            </div>

                                        </div>
                                        @endforeach
                                    </div>

                                    @if ($sujet->statut == 'non_resolu')
                                    <form action="{{ route('show.index', $sujet->id) }}" method="POST" class="row mb-3" style="margin-left: 10px;margin-right: 10px;">
                                        @csrf
                                        <div class="col">
                                            <div class="comment-form-2 d-flex flex-column" data-aos="fade-up" data-aos-easing="linear">
                                                <textarea class="form-custom form-custom-textarea form-control" name="content" rows="12" id="editor"></textarea>

                                                <div class="form-toolbar form-toolbar-bottom row justify-content-between g-2 p-2">
                                                    <div class="col">
                                                        <button type="submit" class="btn btn me-3" style="background-color: #81c408;">Submit</button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button class="btn btn-sm btn-base btn-icon" type="button" title="Delete Draft"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @else
                                    <h3 class="row mb-3" style="margin-left: 10px;margin-right: 10px;text-align: center;">
                                        Ce sujet a été résolu et ne nécessite plus d'intervention.
                                    </h3>

                                    @endif



                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
    </div>
    </section>
    </div>
    @endsection
</body>

</html>