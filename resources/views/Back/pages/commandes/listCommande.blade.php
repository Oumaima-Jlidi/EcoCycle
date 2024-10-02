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
  <h3 class="fw-bold mb-3">Liste des Commandes: {{ $ordersCount }}</h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <!-- Modal update -->
          <div class="modal fade" id="updateRowModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <h5 class="modal-title">
                    <span class="fw-mediumbold"> Mettre à jour</span>
                    <span class="fw-light"> Commande </span>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p class="small">Mettre à jour le statut de la commande</p>
                  <form id="updateOrderForm" action="" method="POST">
                    @csrf 
                    @method('PUT')
                    <input type="hidden" id="orderId" name="order_id">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Statut de la Commande</label>
                          <select id="updateStatus" name="statut" class="form-control" required>
  <option value="Approuvé">Approuvé</option>
  <option value="Rejeté">Rejeté</option>
</select>

                        </div>
                      </div>
                    </div>
                    <div class="modal-footer border-0">
                      <button type="submit" id="updateRowButton" class="btn btn-primary">Mettre à jour</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
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
                  <th>Montant Total</th>
                  <th>Statut</th>
                  <th>Date de Commande</th>
                  <th>Adresse de Livraison</th>
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
                    <div style="display: flex; align-items: center;">
                      <button
                        class="btn btn-link btn-primary btn-edit"
                        title="Edit Task"
                        data-id="{{ $order->id }}"
                        data-status="{{ $order->statut }}"
                      >
                        <i class="fa fa-edit"></i>
                      </button>
                      <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link btn-danger" title="Remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </form>
                    </div>
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

    // Handle click event for edit button
    $(".btn-edit").click(function () {
      const orderId = $(this).data("id");
      const orderStatus = $(this).data("status");

      // Set form action URL
      $("#updateOrderForm").attr("action", `/order/${orderId}`);
      // Populate select field with current status
      $("#orderId").val(orderId);
      $("#updateStatus").val(orderStatus);

      // Show the modal
      $("#updateRowModal").modal("show");
    });
  });
</script>

@endsection
