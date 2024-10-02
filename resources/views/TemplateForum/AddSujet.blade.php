<!DOCTYPE html>
<html lang="en" data-theme="light">


<head>
    <meta charset="UTF-8" >
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
                <div class="col-sm-6 col-lg-3 mb-5">

                  </div>
                   

                        <h4 class="mb-0" data-aos="fade-down" data-aos-easing="linear" style="margin-left: 45px;"><i class="bi bi-plus-circle-dotted me-2"></i> Add Subject</h4>

                        <div class="row g-0">
                            <div class="col-11" style="margin-left: 45px;">
                                <div class="dashboard-card">
                                    <div class="dashboard-body">


                                        <form>
                                            <div class="row g-3">
                                                <div class="col-sm-12" data-aos="fade-up" data-aos-easing="linear">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="title" placeholder="Title">
                                                </div>
                                                <div class="col-sm-12" data-aos="fade-up" data-aos-easing="linear">
                                                    <div class="upload-image my-3">
                                                        <p class="mb-2">PNG, JPG, GIF, WEBP or MP4. Max 200mb.</p>
                                                        <input type="button" class="btn btn-mint btn-md rounded-pill w-25"  style="background-color: #81c408;"value="Browse">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" data-aos="fade-up" data-aos-easing="linear">
                                                    <label class="form-label">Description</label>
                                                    <div class="comment-form-2 d-flex flex-column my-2">

                                                        <!-- Form Editor Toolbar -->
                                                        <div class="form-toolbar form-toolbar-middle d-flex flex-row p-2">
                                                            <ul class="list-inline mb-0">
                                                                <li class="list-inline-item">

                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Undo"><i class="bi bi-arrow-counterclockwise"></i></button>
                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Redo"><i class="bi bi-arrow-clockwise"></i></button>
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-sm btn-base border">Sans-Serif</button>
                                                                        <button type="button" class="btn btn-sm btn-base border dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <span class="visually-hidden">Toggle Dropdown</span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" href="#">Sans-Serif</a></li>
                                                                            <li><a class="dropdown-item" href="#">Monospace</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Font Size"><i class="bi bi-fonts"></i></button>

                                                                </li>

                                                                <li class="list-inline-item">

                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Bold"><i class="bi bi-type-bold"></i></button>
                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Italic"><i class="bi bi-type-italic"></i></button>
                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Underline"><i class="bi bi-type-underline"></i></button>
                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Strikethrough"><i class="bi bi-type-strikethrough"></i></button>

                                                                </li>

                                                                <li class="list-inline-item">

                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Ordered List"><i class="bi bi-list-ol"></i></button>
                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Unordered List"><i class="bi bi-list-ul"></i></button>
                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Indent Decrease"><i class="bi bi-text-indent-right"></i></button>
                                                                    <button class="btn btn-sm btn-icon btn-base" type="button" title="Indent Increase"><i class="bi bi-text-indent-left"></i></button>

                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- Form Editor Toolbar -->

                                                        <!-- Form Textarea -->
                                                        <textarea class="form-custom form-custom-textarea" name="description" rows="5"></textarea>
                                                        <!-- Form Textarea -->

                                                        <!-- Form Bottom Toolbar -->
                                                        <div class="form-toolbar form-toolbar-bottom row justify-content-between g-2 p-2">
                                                            <div class="col">
                                                                <button class="btn btn-sm btn-base btn-icon" type="button" title="Attachment"><i class="bi bi-paperclip"></i></button>
                                                                <button class="btn btn-sm btn-base btn-icon" type="button" title="Link"><i class="bi bi-link-45deg"></i></button>
                                                                <button class="btn btn-sm btn-base btn-icon" type="button" title="Image"><i class="bi bi-image"></i></button>

                                                            </div>
                                                        </div>
                                                        <!-- Form Bottom Toolbar -->
                                                    </div>
                                                </div>
                                                
                                               

                                            </div>
                                            <div class="d-flex pt-5" data-aos="fade-up" data-aos-easing="linear">
                                                <button class="btn btn me-3" style="background-color: #81c408;">Submit</button>
                                                <button class="btn btn-secondary">Save as Draft</button>
                                            </div>
                                        </form>

                                    </div>
                                </div><!--/dashboard-card-->
                            </div>
                        </div>

                    </div>

               
            </div>
        </section>

    </div>
@endsection
</body>

</html>