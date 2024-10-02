<!DOCTYPE html>
<html lang="en" data-theme="light">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Forum & Community Discussions HTML Template">
    <meta name="keywords" content="bootstrap 5, forum, community, support, social, q&a, mobile, html">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 🗨 Comments </title>

    <!-- Inclure les fichiers CSS avec Vite -->
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


        <section class="dashboard">
            <div class="container" style=" padding-top: 64px;">
                <div class="row">
                    <div class="col-sm-12 col-lg-3 mb-5">
                        @include('TemplateForum.Layouts.Menu')

                    </div>

                    <div class="col-12 col-lg-9">

                        <h4 class="mb-4" data-aos="fade-down" data-aos-easing="linear"><i class="bi bi-chat-dots me-2"></i> Comments</h4>

                        <div class="post-box d-flex mb-5 mx-0" data-aos="fade-up" data-aos-easing="linear" style="padding-bottom: 34px;">
                            <div>
                                <div class="card-header card-header-action py-3">
                                    <div class="media align-items-center">
                                        <div class="media-head me-2">
                                            <div class="avatar">
                                                <a href="#"><img src="{{ asset('/forumimg/img/avatar/2.jpg')}}" alt="user" class="avatar-img rounded-circle"></a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div><a href="#" style="color: #81c408 ;">What is your favorite AI project you found recently?</a></div>
                                            <div class="fs-7"><a href="#" style="color: #81c408 ;">Adaline Riley</a><span class="ms-3"> 03 hrs ago in </span> <a href="#" class="cat" style="color: #81c408 ;">AI</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">

                                    <div class="dashboard-comment px-5 py-3 " style="background-color: rgba(121,127,135,.1); border-radius: 15px;">
                                        <h6><b>Your Comment</b></h6>
                                        <p class="my-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et facilis, soluta vitae porro, praesentium deserunt explicabo optio laborum.
                                            Quidem consequuntur modi atque, placeat repellat, perferendis aperiam, fugiat harum ullam aspernatur dicta doloribus qui quo corrupti natus reprehenderit...</p>

                                        <div class="d-flex align-items-center pt-3 pt-sm-0">

                                            <button type="button" class="btn btn-outline-secondary px-3 px-xl-4 me-3">
                                                <i class="bi bi-pen fs-xl me-lg-1 me-xl-2"></i>
                                                <span class="d-none d-lg-inline">Edit</span>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger px-3 px-xl-4">
                                                <i class="bi bi-trash fs-xl me-lg-1 me-xl-2"></i>
                                                <span class="d-none d-lg-inline">Delete</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div><!--/card-->
                        </div>




                        <div class="pagination-2" data-aos="fade-up" data-aos-easing="linear" style="color: #81c408 ;">
                            <ul>
                                <li><a href="#" style="color: #81c408 ;"><i class="bi bi-arrow-left"></i></a></li>
                                <li><a href="#" style="color: #81c408 ;">1</a></li>
                                <li><span class="current">2</span></li>
                                <li><a href="#" style="color: #81c408 ;">3</a></li>
                                <li><a href="#" style="color: #81c408 ;">4</a></li>
                                <li><a href="#" style="color: #81c408 ;"><i class="bi bi-arrow-right"></i></a></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </section>

    </div>
@endsection
</body>

</html>