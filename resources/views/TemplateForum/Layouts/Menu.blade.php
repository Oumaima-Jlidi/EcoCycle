<!-- Sidebar du tableau de bord -->
<div class="dash-sidebar position-sticky" data-aos="fade-right" data-aos-easing="linear">

    <!-- Section pour afficher l'image de profil et le nom de l'utilisateur -->
    <div class="ps-3 d-flex align-items-center">
        <div class="media align-items-center">
            <!-- Conteneur de l'image de profil -->
            <div class="media-head me-2">
                <div class="avatar avatar-lg">
                    <!-- Si l'utilisateur est connecté, afficher son image, sinon afficher une image par défaut -->
                    @if(auth()->check())
                        <!-- Affiche l'image de l'utilisateur si disponible, sinon une image par défaut -->
                        <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('default-profile.png') }}" alt="user" class="avatar-img rounded-circle">
                    @else
                        <!-- Image par défaut pour les utilisateurs non connectés -->
                        <img src="{{ asset('default-profile.png') }}" alt="default user" class="avatar-img rounded-circle">
                    @endif
                </div>
            </div>
            <!-- Section pour afficher le nom de l'utilisateur ou 'Guest' s'il n'est pas connecté -->
            <div class="media-body">
                <h5>{{ auth()->check() ? auth()->user()->name : 'Guest' }}</h5>
            </div>
        </div>

        <!-- Bouton pour toggler la navbar sur les écrans de petite taille -->
        <button class="navbar-toggler ms-auto d-block d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav2"
            aria-controls="navbarNav2" aria-expanded="false" aria-label="Toggle navigation">
            <!-- Icones pour l'animation du toggler -->
            <span class="navbar-toggler-animation">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
    </div>

    <!-- Section pour afficher le menu de navigation de la barre latérale -->
    <div class="navbar-collapse d-xl-block collapse" id="navbarNav2">
        <ul class="navbar-nav flex-column">
            <!-- Section titre pour le Dashboard -->
            <li class="nav-info">Dashboard</li>

            <!-- Lien pour ajouter un Article. Le menu sera actif si la route courante est 'articles.create' -->
            <li class="nav-item {{ url()->current() == route('articles.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('articles.create') }}">
                    <!-- Icône et texte du lien -->
                    <span class="nav-icon-wrap"><i class="bi bi-plus-circle-dotted"></i></span>
                    <span class="nav-link-text">Add Article</span>
                </a>
            </li>

            <!-- Lien pour afficher tous les Article. Le menu sera actif si la route courante est 'articles.store' -->
            <li class="nav-item {{ url()->current() == route('articles.store') ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('articles.store') }}">
                    <span class="nav-icon-wrap"><i class="bi bi-journals"></i></span>
                    <span class="nav-link-text">Articles</span>
                </a>
            </li>

            <!-- Lien pour afficher les commentaires. Le menu sera actif si la route courante est 'replays.index' -->
            <li class="nav-item {{ url()->current() == route('replays.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('replays.index') }}">
                    <span class="nav-icon-wrap"><i class="bi bi-chat-left-dots"></i></span>
                    <span class="nav-link-text">Comments</span>
                </a>
            </li>
            
            <!-- Section titre pour les informations de compte -->
            <li class="nav-info">Account</li>

            <!-- Lien pour la déconnexion (page de login) -->
            <li class="nav-item">
                <a class="nav-link" href="login.html">
                    <!-- Icône et texte pour la déconnexion -->
                    <span class="nav-icon-wrap"><i class="b bi-power"></i></span>
                    <span class="nav-link-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
