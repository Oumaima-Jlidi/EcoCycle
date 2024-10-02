<!DOCTYPE html>
<html lang="en" data-theme="light">


<head>
    <meta charset="UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Forum & Community Discussions HTML Template">
    <meta name="keywords" content="bootstrap 5, forum, community, support, social, q&a, mobile, html">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 📰 Posts</title>

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


    <!-- Back to Top -->

	<div class="vine-wrapper">

		
	


		
        <section class="dashboard">
        <div class="container" style=" padding-top: 64px;">
        <div class="row">

                    <div class="col-sm-12 col-lg-3 mb-5">

                    @include('TemplateForum.Layouts.Menu')
											

                    </div><!--/col-lg-3-->
                    <div class="col-12 col-lg-9">

                        <h4 class="mb-4" data-aos="fade-down" data-aos-easing="linear"><i class="bi bi-journals me-2"></i> Posts</h4>

                        <div class="card mb-4" data-aos="fade-up" data-aos-easing="linear">
                            <div class="card-body">
                              <div class="d-flex justify-content-between mb-4">
                              <a href="#" class="badge fs-sm bg-secondary">AI</a>

                                <span class="fs-sm text-muted">1 hours ago</span>
                              </div>
                              <h5 ><a href="#" style="color: #81c408 ;">Do you think BARD will overtake ChatGPT?</a></h5>
                              <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et facilis, soluta vitae porro, praesentium deserunt explicabo optio laborum. 
                                Quidem consequuntur modi atque, placeat repellat, perferendis aperiam, fugiat harum ullam aspernatur dicta doloribus qui quo corrupti natus reprehenderit...</p>
                           
                              <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center text-muted">
                                  <div class="d-flex align-items-center me-3">
                                    <i class="bi bi-hand-thumbs-up fs-lg me-1"></i>
                                    <span class="fs-sm">8</span>
                                  </div>
                                  <div class="d-flex align-items-center me-3">
                                    <i class="bi bi-chat-dots fs-lg me-1"></i>
                                    <span class="fs-sm">7</span>
                                  </div>
                                  
                                </div>
                                <div class="d-flex justify-content-end pt-3 pt-sm-0">
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

                    </div><!--/col-lg-9-->

                </div>
            </div>
        </section>

		


    </div>
</body>

</html>