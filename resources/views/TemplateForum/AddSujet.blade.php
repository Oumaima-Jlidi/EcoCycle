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
                        <i class="bi bi-plus-circle-dotted me-2"></i> Add Subject
                    </h4>

                    <div class="row g-0">
                        <div class="col-11" style="margin-left: 45px;">
                            <div class="dashboard-card">
                                <div class="dashboard-body">
                              
                                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf 

                                        <div class="row g-3">
                                            <div class="col-sm-12" data-aos="fade-up" data-aos-easing="linear">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="content" placeholder="Title" class="form-control" required>
                                            </div>

                                            <div class="col-sm-12" data-aos="fade-up" data-aos-easing="linear">
                                                <div class="upload-image my-3">
                                                    <p class="mb-2">PNG, JPG, GIF, WEBP or MP4. Max 200mb.</p>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-sm-12" data-aos="fade-up" data-aos-easing="linear">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-custom form-custom-textarea form-control" name="description" rows="12" id="editor" style="display: none;"></textarea>
                                                </div>
                                        </div>

                                        <div class="d-flex pt-5" data-aos="fade-up" data-aos-easing="linear">
                                            <button type="submit" class="btn btn me-3" style="background-color: #81c408;">Submit</button>
                                            <button type="button" class="btn btn-secondary">Save as Draft</button>
                                        </div>
                                    </form>
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