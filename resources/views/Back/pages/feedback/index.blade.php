@extends('Back.admin')

@section('content')
<!-- Fonts and icons -->
<script src="../js/plugin/webfont/webfont.min.js"></script>
<script>
  WebFont.load({
    google: { families: ["Public Sans:300,400,500,600,700"] },
    custom: {
      families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
      urls: ["../css/fonts.min.css"],
    },
    active: function() { sessionStorage.fonts = true; }
  });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/plugins.min.css" />
<link rel="stylesheet" href="../css/kaiadmin.min.css" />

<!-- Page Content -->
<div class="page-inner">
  <div class="page-header">
    <h3 class="fw-bold mb-3">Liste des Feedbacks des events</h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
       
          <div class="table-responsive">
            <table id="add-row" class="display table table-striped table-hover">
              <thead>
                <tr>
                  <th>contenu</th>
                  <th>avis</th>
                  <th>Utilisateur</th>
                  <th>Evenement</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($feedbacks as $feedback)
              <tr>
                  <td>{{ $feedback->comment }}</td>
                  <td>{{ $feedback->rating }}</td>
                  <td>{{ $feedback->user->name ?? 'Anonyme' }}</td>
                  <td>{{ $feedback->event->title ?? 'Événement non spécifié' }}</td>

                  <td>
                    <div class="form-button-action">
                    <form action="{{ route('feedback.toggle', $feedback->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-link {{ $feedback->status ? 'btn-success' : 'btn-warning' }}">
                <i class="fa {{ $feedback->status ? 'fa-check' : 'fa-times' }}"></i>
                {{ $feedback->status ? 'Désactiver' : 'Activer' }}
            </button>
        </form>
                    <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce feedback ?');">
        <i class="fa fa-times"></i>
    </button>
</form>
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
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });
        $("#add-row").DataTable({
          pageLength: 5,
        });
      }); 

</script>

@endsection