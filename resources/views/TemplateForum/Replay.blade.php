<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères pour la page -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Assure la compatibilité avec Internet Explorer -->

    <meta name="description" content="Forum & Community Discussions HTML Template"> <!-- Description de la page pour le SEO -->
    <meta name="keywords" content="bootstrap 5, forum, community, support, social, q&a, mobile, html"> <!-- Mots-clés pour le SEO -->
    <meta name="robots" content="all,follow"> <!-- Indique aux robots d'indexation de suivre les liens -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Règle le comportement de la mise en page sur les appareils mobiles -->
    <title> 🗨 Comments </title> <!-- Titre de la page affiché dans l'onglet du navigateur -->

    <!-- Inclure les fichiers CSS et JS avec Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Utilisation de Vite pour charger les ressources CSS et JavaScript -->
</head>

<body>
    <div class="switcher switcher-show" id="theme-switcher" style="margin-bottom: 55px; margin-right: -8px;"> <!-- Switcher de thème pour changer le style -->
        <i id="switcher-icon" class="bi bi-moon"></i> <!-- Icône pour le switcher de thème -->
    </div>
    @extends('Front.frontIndex') <!-- Héritage de la mise en page de base définie dans frontIndex -->

    @section('frontSection') <!-- Début de la section spécifique aux commentaires -->

    <div class="vine-wrapper"> <!-- Conteneur principal pour la mise en page des commentaires -->

        <section class="dashboard"> <!-- Section principale pour le tableau de bord -->
            <div class="container" style="padding-top: 64px;"> <!-- Conteneur pour centrer le contenu -->
                <div class="row"> <!-- Ligne pour la mise en page -->
                    <div class="col-sm-12 col-lg-3 mb-5"> <!-- Colonne pour le menu latéral -->
                        @include('TemplateForum.Layouts.Menu') <!-- Inclusion du menu de navigation -->
                    </div>

                    <div class="col-12 col-lg-9"> <!-- Colonne principale pour les commentaires -->
                        <h4 class="mb-4" data-aos="fade-down" data-aos-easing="linear"><i class="bi bi-chat-dots me-2"></i> Comments</h4> <!-- Titre de la section des commentaires -->

                        <div class="post-box d-flex mb-5 mx-0" data-aos="fade-up" data-aos-easing="linear" style="padding-bottom: 34px;"> <!-- Boîte de commentaire -->
                            <div>
                                <div class="card-header card-header-action py-3"> <!-- En-tête de la carte pour le commentaire -->
                                    <div class="media align-items-center"> <!-- Conteneur pour le contenu média (image et texte) -->
                                        <div class="media-head me-2">
                                            <div class="avatar"> <!-- Conteneur pour l'avatar de l'utilisateur -->
                                                <a href="#"><img src="{{ asset('/forumimg/img/avatar/2.jpg')}}" alt="user" class="avatar-img rounded-circle"></a> <!-- Image de l'avatar -->
                                            </div>
                                        </div>
                                        <div class="media-body"> <!-- Conteneur pour le texte du commentaire -->
                                            <div><a href="#" style="color: #81c408 ;">What is your favorite AI project you found recently?</a></div> <!-- Titre du commentaire -->
                                            <div class="fs-7"><a href="#" style="color: #81c408 ;">Adaline Riley</a><span class="ms-3"> 03 hrs ago in </span> <a href="#" class="cat" style="color: #81c408 ;">AI</a></div> <!-- Informations sur l'auteur et le temps écoulé -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer"> <!-- Pied de la carte pour les actions sur le commentaire -->
                                    <div class="dashboard-comment px-5 py-3 " style="background-color: rgba(121,127,135,.1); border-radius: 15px;"> <!-- Conteneur pour le texte du commentaire -->
                                        <h6><b>Your Comment</b></h6> <!-- Titre pour la section de commentaire -->
                                        <p class="my-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et facilis, soluta vitae porro, praesentium deserunt explicabo optio laborum.
                                            Quidem consequuntur modi atque, placeat repellat, perferendis aperiam, fugiat harum ullam aspernatur dicta doloribus qui quo corrupti natus reprehenderit...</p> <!-- Texte du commentaire -->
                                        <div class="d-flex align-items-center pt-3 pt-sm-0"> <!-- Conteneur pour les boutons d'action -->
                                            <button type="button" class="btn btn-outline-secondary px-3 px-xl-4 me-3"> <!-- Bouton pour éditer le commentaire -->
                                                <i class="bi bi-pen fs-xl me-lg-1 me-xl-2"></i> <!-- Icône d'édition -->
                                                <span class="d-none d-lg-inline">Edit</span> <!-- Texte du bouton (caché sur petits écrans) -->
                                            </button>
                                            <button type="button" class="btn btn-outline-danger px-3 px-xl-4"> <!-- Bouton pour supprimer le commentaire -->
                                                <i class="bi bi-trash fs-xl me-lg-1 me-xl-2"></i> <!-- Icône de suppression -->
                                                <span class="d-none d-lg-inline">Delete</span> <!-- Texte du bouton (caché sur petits écrans) -->
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/card-->
                        </div>

                        <!-- Pagination (actuellement en durcodé) -->
                        <div class="pagination-2" data-aos="fade-up" data-aos-easing="linear" style="color: #81c408 ;">
                            <ul>
                                <li><a href="#" style="color: #81c408 ;"><i class="bi bi-arrow-left"></i></a></li> <!-- Flèche vers la gauche -->
                                <li><a href="#" style="color: #81c408 ;">1</a></li> <!-- Numéro de page -->
                                <li><span class="current">2</span></li> <!-- Page actuelle -->
                                <li><a href="#" style="color: #81c408 ;">3</a></li> <!-- Autres numéros de page -->
                                <li><a href="#" style="color: #81c408 ;">4</a></li>
                                <li><a href="#" style="color: #81c408 ;"><i class="bi bi-arrow-right"></i></a></li> <!-- Flèche vers la droite -->
                            </ul>
                        </div>

                    </div> <!-- Fin de la colonne principale -->
                </div> <!-- Fin de la ligne -->
            </div> <!-- Fin du conteneur -->
        </section>
    </div> <!-- Fin du wrapper principal -->

    @endsection <!-- Fin de la section -->
</body>

</html>
