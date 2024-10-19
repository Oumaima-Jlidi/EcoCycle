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
    <h3 class="fw-bold mb-3">Liste des Produits</h3>

  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Ajouter Produit</h4>
            <button
              class="btn btn-primary btn-round ms-auto"
              data-bs-toggle="modal"
              data-bs-target="#addRowModal">
              <i class="fa fa-plus"></i>
              Ajouter Produit
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
                    <span class="fw-light"> Produit </span>
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
                    Créer un nouveau Produit
                  </p>
                  <form action="{{ route('produit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <!-- Dropdown for selecting a category from the database -->
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Catégorie de Produit</label>
                          <select name="categorie_id" class="form-control" required>
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Nom</label>
                          <input id="addName" type="text" name="nom" class="form-control" placeholder="nom du produit" required />
                        </div>
                      </div>

                      <div class="col-md-6 pe-0">
                        <div class="form-group form-group-default">
                          <label>Quantité</label>
                          <input id="addMarque" type="text" name="quantite" class="form-control" placeholder="Quantité produit" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-group-default">
                          <label>Prix</label>
                          <input id="addPrix" type="text" name="prix" class="form-control" placeholder="Prix Produit" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Description</label>
                          <input id="addDescription" type="text" name="description" class="form-control" placeholder="Description Produit" required />
                        </div>
                      </div>

                      <!-- Nouveau champ pour l'image -->
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Image du produit</label>
                          <input type="file" name="image" class="form-control" />
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

          <!-- Modal   update  -->
          <div
            class="modal fade"
            id="editRowModal"
            tabindex="-1"
            role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <h5 class="modal-title">
                    <span class="fw-mediumbold">Modifier</span>
                    <span class="fw-light"> Produit </span>
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
                  <p class="small">Modifier le produit sélectionné</p>
                  <form id="editProduitForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Catégorie de Produit</label>
                          <select id="editCategorie" name="categorie_id" class="form-control" required>
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
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
                          <label>Prix</label>
                          <input
                            id="editPrix"
                            type="text"
                            name="prix"
                            class="form-control"
                            placeholder="prix du produit"
                            required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Quantité</label>
                          <input
                            id="editQuantite"
                            type="text"
                            name="quantite"
                            class="form-control"
                            placeholder="quantite du produit"
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
                            placeholder="Description de produit"
                            required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Image (facultatif)</label>
                          <input
                            id="editImage"
                            type="file"
                            name="image"
                            class="form-control" />
                          <small class="form-text text-muted">Formats acceptés: jpeg, png, jpg, gif.</small>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer border-0">
                      <button
                        type="submit"
                        class="btn btn-primary">
                        Mettre à jour
                      </button>
                      <button
                        type="button"
                        class="btn btn-danger"
                        id="cancelButton">
                        Annuler
                      </button>
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
                  <th>Name</th>
                  <th>quantite</th>
                  <th>Prix</th>
                  <th>Description</th>
                  <th>Categorie</th>
                  <th style="width: 10%">Action</th>
                </tr>
              </thead>
              <tfoot>

                <tr>
                  <th>Name</th>
                  <th>quantite</th>
                  <th>prix</th>
                  <th>Description</th>
                  <th>Categorie</th>
                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach($produits as $produit)
                <tr>
                  <td>{{ $produit->nom }}</td>
                  <td>{{ $produit->quantite }}</td>
                  <td>{{ $produit->prix }}</td>
                  <td>{{ $produit->description }}</td>
                  <td>{{ $produit->categorie ? $produit->categorie->nom : 'Aucune catégorie' }}</td>

                  <td>
                    <div style="display: flex; align-items: center;">
                      <button
                        class="btn btn-link btn-primary"
                        title="Modifier le Produit"
                        data-bs-toggle="modal"
                        data-bs-target="#editRowModal"
                        onclick="setEditProduitData('{{ $produit->id }}', '{{ $produit->nom }}','{{ $produit->prix }}' ,'{{ $produit->quantite }}','{{ $produit->description }}')">
                        <i class="fa fa-edit"></i>
                      </button>
                      <form action="{{ route('produit.destroy', $produit->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link btn-danger" title="Remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </form>
                    </div>
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


</div>
<!--   Core JS Files   -->
<script src="../js/core/jquery-3.7.1.min.js"></script>
<script src="../js/core/popper.min.js"></script>
<script src="../js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="../js/plugin/datatables/datatables.min.js"></script>
<!-- Kaiadmin JS -->
<script src="../js/kaiadmin.min.js"></script>
<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="../js/setting-demo2.js"></script>
<script>
  $(document).ready(function() {
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
      pageLength: 5,
      initComplete: function() {
        this.api()
          .columns()
          .every(function() {
            var column = this;
            var select = $(
                '<select class="form-select"><option value=""></option></select>'
              )
              .appendTo($(column.footer()).empty())
              .on("change", function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                  .search(val ? "^" + val + "$" : "", true, false)
                  .draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function(d, j) {
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
              });
          });
      },
    });

    // Add Row
    $("#add-row").DataTable({
      pageLength: 5,
    });

    var action =
      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';
    $("#addRowButton").click(function() {
      // Assurez-vous que vous avez le même nombre de données que de colonnes dans le tableau
      $("#add-row").dataTable().fnAddData([
        $("#addName").val(), // 1ère colonne: Nom
        $("#addMarque").val(), // 2ème colonne: Marque
        $("#addPrix").val(), // 3ème colonne: Prix
        $("#addDescription").val(), // 4ème colonne: Description
        action // 5ème colonne: Action (boutons modifier/supprimer)
      ]);
      $("#addRowModal").modal("hide");
    });

  });

  function setEditProduitData(id, nom, prix, quantite, description) {
    // Mettre à jour l'action du formulaire
    document.getElementById('editProduitForm').action = '/produit/' + id; // Assurez-vous que c'est la bonne URL

    // Remplir les champs du modal
    document.getElementById('editName').value = nom;
    document.getElementById('editPrix').value = prix;
    document.getElementById('editQuantite').value = quantite;
    document.getElementById('editDescription').value = description;
  }
</script>
<script>
  document.getElementById('cancelButton').addEventListener('click', function() {
    window.location.href = '/produit'; // Redirect to /produit
  });
</script>
@endsection