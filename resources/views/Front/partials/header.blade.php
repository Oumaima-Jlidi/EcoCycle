<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="index.html" class="navbar-brand"><h1 class="text-primary display-6">EcoCycle</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="index.html" class="nav-item nav-link {{ request()->is('index.html') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('articles.indexfront') }}" class="nav-item nav-link">Articles</a>
                    <a href="{{ route('produits.indexFront') }}" class="nav-item nav-link {{ request()->is('produits/indexFront') ? 'active' : '' }}">Shop</a>
                    <a href="{{ route('forum.index') }}" class="nav-item nav-link {{ request()->is('forum') ? 'active' : '' }}">Forum</a>
                    <a href="{{ route('collects.indexfront') }}" class="nav-item nav-link {{ request()->is('collects/indexfront') ? 'active' : '' }}">Collects</a>
                    <a href="{{ route('events.indexFront') }}" class="nav-item nav-link {{ request()->is('events/indexFront') ? 'active' : '' }}">Events</a>
                    <a href="{{ route('events.calender') }}" class="nav-item nav-link {{ request()->is('events/calender') ? 'active' : '' }}">Calender</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                    <a href="{{ route('cart.show') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
        {{ $cartCount }}
    </span>                    </a>
                    @if (Auth::check())
                        <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}" class="my-auto">
                            <i class="fas fa-user fa-2x"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('Log In') }}
                        </a>
                    @endif

                    @guest
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ __('Log In') }}
                        </a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
    </div>
</div>