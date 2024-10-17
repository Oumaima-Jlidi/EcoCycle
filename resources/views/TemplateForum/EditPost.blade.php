<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Forum & Community Discussions HTML Template">
    <meta name="keywords" content="bootstrap 5, forum, community, support, social, q&a, mobile, html">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ➕ Edit Post</title>
    <link href="frontCss/css/bootstrap.min.css" rel="stylesheet">
    <link href="frontCss/css/style.css" rel="stylesheet">
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
                <h4 class="mb-0" data-aos="fade-down" data-aos-easing="linear" style="margin-left: 45px;">
                    <i class="bi bi-pencil-square me-2"></i> Edit Subject
                </h4>

                <div class="row g-0">
                    <div class="col-11" style="margin-left: 45px;">
                        <div class="dashboard-card">
                            <div class="dashboard-body">
                                <!-- Display success or error messages -->
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <!-- Form to edit the subject -->
                                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-3">
                                        <label for="titre">Title</label>
                                        <input type="text" name="titre" class="form-control" value="{{ old('titre', $article->titre) }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="contenu">Description</label>
                                        <textarea name="contenu" class="form-control" rows="5" required>{{ old('contenu', $article->contenu) }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="Nom_auteur">Nom de l'Auteur</label>
                                        <input type="text" name="Nom_auteur" class="form-control" value="{{ old('Nom_auteur', $article->Nom_auteur) }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="statut">Statut</label>
                                        <select name="statut" class="form-control" required>
                                            <option value="resolu" {{ $article->statut == 'resolu' ? 'selected' : '' }}>Résolu</option>
                                            <option value="non_resolu" {{ $article->statut == 'non_resolu' ? 'selected' : '' }}>Non Résolu</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="image">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        @if($article->image)
                                            <p>Current Image:</p>
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="Subject Image" width="150">
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Subject</button>
                                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
                                </form>
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
