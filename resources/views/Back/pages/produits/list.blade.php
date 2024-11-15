@extends('Back.admin')
@section('content')
<!-- Fonts and icons -->
<script src="../js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["../css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/plugins.min.css" />
<link rel="stylesheet" href="../css/kaiadmin.min.css" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="../css/demo.css" />
</head>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Liste des Categorie</h3>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Ajouter Categorie</h4>
                        <button

                            class="btn btn-primary btn-round ms-auto"
                            data-bs-toggle="modal"
                            data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Ajouter Categorie
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal   add  -->
                    <div
                        class="modal fade"
                        id="addRowModal"
                        tabindex="-1"
                        role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold"> Ajouter</span>
                                        <span class="fw-light"> Categorie </span>
                                    </h5>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">
                                        Créer un nouveau Categorie
                                    </p>
                                    <form id="formCateg" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nom</label>
                                                    <input id="addName" type="text" name="nom" class="form-control" placeholder="nom du Categorie" required />
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Description</label>
                                                    <input id="addDescription" type="text" name="description" class="form-control" placeholder="Description Categorie" required />
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="submit" id="addRowButton" class="btn btn-primary">Ajouter</button>
                                            <button type="cancel" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                        <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    your form is not valid !
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal   update  -->
                    <div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">Modifier</span>
                                        <span class="fw-light"> Categorie </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Modifier le Categorie sélectionné</p>
                                    <form id="editProduitForm" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nom</label>
                                                    <input
                                                        id="editName"
                                                        type="text"
                                                        name="nom"
                                                        class="form-control"
                                                        placeholder="nom du produit"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Description</label>
                                                    <input
                                                        id="editDescription"
                                                        type="text"
                                                        name="description"
                                                        class="form-control"
                                                        placeholder="Description Categorie"
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            id="add-row"
                            class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Nombre de Produits</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>

                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Nombre de Produits</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($categories as $categorie)
                                <tr>
                                    <td>{{ $categorie->id }}</td>
                                    <td>{{ $categorie->nom }}</td>
                                    <td>{{ $categorie->description }}</td>
                                    <td>{{ $categorie->created_at }}</td>
                                    <td>{{ $categorie->updated_at }}</td>
                                    <td>{{ $categorie->produits_count }}</td>


                                    <td>
                                        <button
                                            class="btn btn-link btn-primary"
                                            title="Modifier la Categorie"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editRowModal"
                                            onclick="setEditProduitData('{{ $categorie->id }}', '{{ $categorie->nom }}', '{{ $categorie->description }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link btn-danger" title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @endforeach

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Core JS Files -->
<script src="../js/core/jquery-3.7.1.min.js"></script>
<script src="../js/core/popper.min.js"></script>
<script src="../js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="../js/plugin/datatables/datatables.min.js"></script>
<!-- Kaiadmin JS -->
<script src="../js/kaiadmin.min.js"></script>

<script>
    $(document).ready(function() {
        $('#add-row').DataTable();
    });

    function setEditProduitData(id, nom, description) {
        $('#editProduitForm').attr('action', '/categories/' + id);
        $('#editName').val(nom);
        $('#editDescription').val(description);
    }
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('formCateg').addEventListener('submit', function(event) {
            const name = document.getElementById('addName').value.trim();
            const desc = document.getElementById('addDescription').value.trim();

            // Définir des critères spécifiques pour chaque champ
            const namePattern = /^.{5,}$/; // Nom : au moins 5 caractères
            const descPattern = /^.{10,}$/; // Description : au moins 10 caractères

            let isValid = true;

            // Validation du nom
            if (!namePattern.test(name)) {
                isValid = false;
                alert("Le nom doit contenir au moins 5 caractères.");
            }

            // Validation de la description
            if (!descPattern.test(desc)) {
                isValid = false;
                alert("La description doit contenir au moins 10 caractères.");
            }

            if (!isValid) {
                event.preventDefault(); // Empêcher la soumission du formulaire

                // Afficher la toast d'erreur
                const toastElement = document.getElementById('errorToast');
                const bootstrapToast = new bootstrap.Toast(toastElement);
                bootstrapToast.show();
            }
        });
    });
</script>

@endsection