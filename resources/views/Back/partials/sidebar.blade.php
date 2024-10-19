<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
<h1>EcoCycle</h1>            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <!-- Dashboard Section -->
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- Test Page Section -->

                <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-users"></i>
                        <p>gestion des users</p>
                    </a>
                </li>


                <li class="nav-item {{ request()->routeIs('role.index') ? 'active' : '' }}">
                    <a href="{{ route('role.index') }}">
                        <i class="fas fa-user-shield"></i>
                        <p>gestion des roles</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('event.index') ? 'active' : '' }}">
                    <a href="{{ route('event.index') }}">
                        <i class="fas fa-user-shield"></i>
                        <p>gestion des evenements </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('feedback.index') ? 'active' : '' }}">
                    <a href="{{ route('feedback.index') }}">
                        <i class="fas fa-user-shield"></i>
                        <p>gestion des feedbacks </p>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->routeIs('produit.index') ? 'active' : '' }}"> 
                     <a href="{{ route('produit.index') }}">
                       <i class="fas fa-cubes"></i>
                       <p>Gestion des Produits</p>
                     </a>
                </li>
                <li class="nav-item {{ request()->routeIs('order.index') ? 'active' : '' }}"> 
  <a href="{{ route('order.index') }}">
    <i class="fas fa-box"></i>
    <p>Gestion des Commandes</p>
  </a>
</li>


                <li class="nav-item {{ request()->routeIs('collectes.index') ? 'active' : '' }}">
                    <a href="{{ route('collectes.index') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>gestion des collectes</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('dechets.index') ? 'active' : '' }}">
                    <a href="{{ route('dechets.index') }}">
                        <i class="fas fa-file-alt"></i>
                        <p>gestion des dechets</p>
                    </a>
                </li>

              
            </ul>
            <div class="d-flex flex-column justify-content-end align-items-center" style="height:60vh;">
    <div class="mb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="btn btn-danger"
                style="padding: 10px 20px; border-radius: 5px;"
            >
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>



            <!-- End Logout Form -->
        </div>
    </div>
</div>
