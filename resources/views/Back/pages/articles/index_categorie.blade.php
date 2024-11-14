@extends('Back.admin')
@section('content')

<!-- Imports des polices et icônes -->
<script src="../js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
            families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
            urls: ["../css/fonts.min.css"],
        },
        active: function() { sessionStorage.fonts = true; },
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/plugins.min.css" />
<link rel="stylesheet" href="../css/kaiadmin.min.css" />

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Liste des Catégories d'Articles</h3>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Ajouter Catégorie</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i> Ajouter Catégorie
                        </button>
                    </div>
                </div>

                <!-- Modal d'ajout -->
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">Ajouter Catégorie</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('categorie_articles.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="nom" class="form-control" placeholder="Nom de la catégorie" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control" placeholder="Description" required />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tableau des catégories -->
                <div class="table-responsive">
                    <table id="categories-table" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Créé le</th>
                                <th>Mis à jour le</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $categorie)
                            <tr>
                                <td>{{ $categorie->id }}</td>
                                <td>{{ $categorie->nom }}</td>
                                <td>{{ $categorie->description }}</td>
                                <td>{{ $categorie->created_at }}</td>
                                <td>{{ $categorie->updated_at }}</td>
                                <td>
                                    <button class="btn btn-link btn-primary" title="Modifier la Catégorie" data-bs-toggle="modal" data-bs-target="#editRowModal" onclick="setEditCategorieData('{{ $categorie->id }}', '{{ $categorie->nom }}', '{{ $categorie->description }}')">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('categorie_articles.destroy', $categorie->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-danger" title="Supprimer">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal de modification -->
                <div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">Modifier Catégorie</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editCategorieForm" action="" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input id="editName" type="text" name="nom" class="form-control" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input id="editDescription" type="text" name="description" class="form-control" required />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function setEditCategorieData(id, nom, description) {
        $('#editCategorieForm').attr('action', '/categorie_articles/' + id);
        $('#editName').val(nom);
        $('#editDescription').val(description);
    }
</script>

@endsection
