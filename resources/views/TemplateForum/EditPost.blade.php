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
    <link href="frontCss/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="frontCss/css/style.css" rel="stylesheet">
    <!-- Include CSS and JS files using Vite -->
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
                    <div class="col-sm-6 col-lg-3 mb-5">
                    </div>

                    <h4 class="mb-0" data-aos="fade-down" data-aos-easing="linear" style="margin-left: 45px;">
                        <i class="bi bi-plus-circle-dotted me-2"></i> Edit  Subject
                    </h4>

                    <div class="row g-0">
                        <div class="col-11" style="margin-left: 45px;">
                            <div class="dashboard-card">
                                <div class="dashboard-body">
                                    <!-- Display any success or error messages -->
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                    @endif

                                    <!-- Form to edit the subject -->
                                    <form action="{{ route('posts.update', $sujet->id) }}" method="POST" enctype="multipart/form-data" id="add-post-form">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group mb-3">
                                            <label for="content">Title</label>
                                            <input type="text" name="content" class="form-control" value="{{ $sujet->content }}" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" rows="5"  id="editor"required>{{ $sujet->description }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
    <label for="statut">Statut</label>
    <select name="statut" class="form-control" required>
        <option value="resolu" {{ $sujet->statut == 'resolu' ? 'selected' : '' }}>Resolu</option>
        <option value="non_resolu" {{ $sujet->statut == 'non_resolu' ? 'selected' : '' }}>Non Resolu</option>
    </select>
</div>

                                        <div class="form-group mb-3">
                                            <label for="image">Upload Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                        <div class="form-group mb-3">
                                            @if($sujet->image)
                                            <p>Current Image:</p>
                                            <img src="{{ asset('storage/' . $sujet->image) }}" alt="Subject Image" width="150">
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update Subject</button>
                                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                                    </form>
                                </div>
        </section>
    </div>
    @endsection

</body>

</html>