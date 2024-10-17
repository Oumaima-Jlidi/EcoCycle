<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Forum & Community Discussions HTML Template">
    <meta name="keywords" content="bootstrap 5, forum, community, support, social, q&a, mobile, html">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📰 Articles</title>

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
        <section class="dashboard">
            <div class="container" style="padding-top: 64px;">
                <div class="row">
                    <div class="col-sm-12 col-lg-3 mb-5">
                        @include('TemplateForum.Layouts.Menu')
                    </div><!--/col-lg-3-->

                    <div class="col-12 col-lg-9">
                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('articles.create') }}" class="btn btn-primary">Créer un nouvel article</a>
                        </div>
                        
                        <h4 class="mb-4" data-aos="fade-down" data-aos-easing="linear">
                            <i class="bi bi-journals me-2"></i> Articles
                        </h4>

                        @foreach($articles as $article)
                        <div class="card mb-4" data-aos="fade-up" data-aos-easing="linear">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-4">
                                    <a href="#" class="badge fs-sm bg-secondary">{{ $article->category }}</a>
                                    <span class="fs-sm text-muted">{{ $article->created_at->diffForHumans() }}</span>
                                </div>

                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article" class="img-fluid mb-3">
                                @endif

                                <h5><a href="#" style="color: #81c408;">{{ $article->titre }}</a></h5>
                                <p class="mb-4">{{ Str::limit($article->contenu, 150) }}</p>

                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center text-muted">
                                        <div class="d-flex align-items-center me-3">
                                            <i class="bi bi-hand-thumbs-up fs-lg me-1"></i>
                                            <span class="fs-sm">{{ $article->likes ?? 0 }}</span>
                                        </div>
                                        <div class="d-flex align-items-center me-3">
                                            <i class="bi bi-chat-dots fs-lg me-1"></i>
                                            <span class="fs-sm">{{ $article->comments_count ?? 0 }}</span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end pt-3 pt-sm-0">
                                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-secondary px-3 px-xl-4 me-3">
                                            <i class="bi bi-pen fs-xl me-lg-1 me-xl-2"></i>
                                            <span class="d-none d-lg-inline">Edit</span>
                                        </a>
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger px-3 px-xl-4">
                                                <i class="bi bi-trash fs-xl me-lg-1 me-xl-2"></i>
                                                <span class="d-none d-lg-inline">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!--/card-->
                        @endforeach

                        <div class="pagination-2" data-aos="fade-up" data-aos-easing="linear" style="color: #81c408;">
                            {{ $articles->links() }}
                        </div>

                    </div><!--/col-lg-9-->
                </div>
            </div>
        </section>
    </div>
</body>

</html>
