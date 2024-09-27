

    <div class="dash-sidebar position-sticky" data-aos="fade-right" data-aos-easing="linear">

        <div class="ps-3 d-flex align-items-center">
            <div class="media align-items-center">
                <div class="media-head me-2">
                    <div class="avatar avatar-lg">
                        <img src="{{ asset('/forumimg/img/avatar/1.jpg') }}" alt="user" class="avatar-img rounded-circle">
                    </div>
                </div>
                <div class="media-body">
                    <h5>Abram Marvyn</h5>
                    <p class="small mb-0">Member since 2009</p>
                </div>
            </div>

            <!-- Responsive navbar toggler -->
            <button class="navbar-toggler ms-auto d-block d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav2"
                aria-controls="navbarNav2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-animation">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>

        <div class="navbar-collapse d-xl-block collapse" id="navbarNav2">
            <ul class="navbar-nav flex-column">
                <li class="nav-info">Dashboard </li>

                <li class="nav-item {{ url()->current() == route('posts.add') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('posts.add') }}">
                    <span class="nav-icon-wrap"><i class="bi bi-plus-circle-dotted"></i></span>
                    <span class="nav-link-text">Add Post</span>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('posts.index') ? 'active' : '' }}">
            <a class="nav-link " href="{{ route('posts.index') }}">
                    <span class="nav-icon-wrap"><i class="bi bi-journals"></i></span>
                    <span class="nav-link-text">Posts</span>
                </a>
            </li>
            <li class="nav-item {{ url()->current() == route('replays.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('replays.index') }}">
                        <span class="nav-icon-wrap"><i class="bi bi-chat-left-dots"></i></span>
                        <span class="nav-link-text">Comments</span>
                    </a>
                </li>
                
                <li class="nav-info">Account </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="login.html">
                        <span class="nav-icon-wrap"><i class="b bi-power"></i></span>
                        <span class="nav-link-text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>


    </div>
