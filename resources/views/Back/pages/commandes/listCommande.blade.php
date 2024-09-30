@extends('Back.admin')
@section('content') 

<!-- Fonts and icons -->
<script src="../js/plugin/webfont/webfont.min.js"></script>
<script>
  WebFont.load({
    google: { families: ["Public Sans:300,400,500,600,700"] },
    custom: {
      families: [
        "Font Awesome 5 Solid",
        "Font Awesome 5 Regular",
        "Font Awesome 5 Brands",
        "simple-line-icons",
      ],
      urls: ["../css/fonts.min.css"],
    },
    active: function () {
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

<div class="page-inner">
  <div class="page-header">
    <h3 class="fw-bold mb-3">Liste des Commandes</h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Ajouter Commande</h4>
            <button
              class="btn btn-primary btn-round ms-auto"
              data-bs-toggle="modal"
              data-bs-target="#addRowModal"
            >
              <i class="fa fa-plus"></i>
              Ajouter Commande
            </button>
          </div>
        </div>
        <div class="card-body">
          <!-- Modal add -->
          <div
            class="modal fade"
            id="addRowModal"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <h5 class="modal-title">
                    <span class="fw-mediumbold"> Ajouter</span>
                    <span class="fw-light"> Commande </span>
                  </h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p class="small">
                    Créer une nouvelle commande
                  </p>
                  <form action="{{ route('order.store') }}" method="POST">
                  @csrf 
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Nom du client</label>
                          <input
                            id="addCustomerName"
                            type="text"
                            name="customer_name"
                            class="form-control"
                            placeholder="Nom du client"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Produit</label>
                          <input
                            id="addProduct"
                            type="text"
                            name="product"
                            class="form-control"
                            placeholder="Produit commandé"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-md-6 pe-0">
                        <div class="form-group form-group-default">
                          <label>Quantité</label>
                          <input
                            id="addQuantity"
                            type="text"
                            name="quantity"
                            class="form-control"
                            placeholder="Quantité"
                            required
                          />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-group-default">
                          <label>Prix Total</label>
                          <input
                            id="addTotalPrice"
                            type="text"
                            name="total_price"
                            class="form-control"
                            placeholder="Prix Total"
                            required
                          />
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer border-0">
                      <button
                        type="submit"
                        id="addRowButton"
                        class="btn btn-primary"
                      >
                        Ajouter
                      </button>
                      <button
                        type="cancel"
                        class="btn btn-danger"
                        data-dismiss="modal"
                      >
                        Annuler
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="table-responsive">
          <table id="add-row" class="display table table-striped table-hover">
  <thead>
    <tr>
      <th>Montant Total</th>  <!-- Changed from "Client" to "Montant Total" -->
      <th>Statut</th>        <!-- Changed from "Produit" to "Statut" -->
      <th>Date de Commande</th> <!-- Changed from "Quantité" to "Date de Commande" -->
      <th>Adresse de Livraison</th> <!-- Changed from "Prix Total" to "Adresse de Livraison" -->
      <th style="width: 10%">Action</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Montant Total</th> 
      <th>Statut</th>
      <th>Date de Commande</th>
      <th>Adresse de Livraison</th>
      <th>Action</th>
    </tr>
  </tfoot>
  <tbody>
    @foreach($orders as $order)
    <tr>
      <td>{{ $order->montant_total }}</td>
      <td>{{ $order->statut }}</td>
      <td>{{ $order->date_commande }}</td>
      <td>{{ $order->adresse_livraison }}</td>
      <td>
        <!-- Action buttons can be added here -->
      </td>
    </tr>
    @endforeach
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
  $(document).ready(function () {
    $("#add-row").DataTable({
      pageLength: 5,
    });

    $("#addRowButton").click(function () {
      // Add row to the orders table
      $("#add-row").dataTable().fnAddData([
        $("#addCustomerName").val(), 
        $("#addProduct").val(), 
        $("#addQuantity").val(), 
        $("#addTotalPrice").val(), 
        '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Order"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>'
      ]);
      $("#addRowModal").modal("hide");
    });
  });
</script>

@endsection
