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
    <h3 class="fw-bold mb-3">Liste des Événements</h3>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Ajouter Événement</h4>
            <button
              class="btn btn-primary btn-round ms-auto"
              data-bs-toggle="modal"
              data-bs-target="#addRowModal">
              <i class="fa fa-plus"></i>
              Ajouter Événement
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
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <h5 class="modal-title">
                    <span class="fw-mediumbold"> Ajouter</span>
                    <span class="fw-light"> Événement </span>
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
                    Créer un nouveau Événement
                  </p>
                  <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Nom de l'Événement</label>
                          <input id="addName" type="text" name="title" class="form-control" placeholder="Nom de l'événement" required />
                        </div>
                      </div>

                      <div class="col-md-6 pe-0">
                        <div class="form-group form-group-default">
                          <label>Date de Début</label>
                          <input id="addStartDate" type="datetime-local" name="start_date" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-group-default">
                          <label>Date de Fin</label>
                          <input id="addEndDate" type="datetime-local" name="end_date" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Description</label>
                          <input id="addDescription" type="text" name="description" class="form-control" placeholder="Description de l'événement" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Lieu</label>
                          <input id="location" type="text" name="location" class="form-control" placeholder="Lieu de l'événement" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Participants</label>
                          <input id="participants" type="text" name="max_participants" class="form-control" placeholder="Participants de l'événement" required />
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
    <!-- Modal update -->
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
                    <span class="fw-light"> Événement </span>
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
                  <p class="small">Modifier l'événement sélectionné</p>
                  <form id="editEventForm" action="" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Nom de l'Événement</label>
                          <input id="editTitle" type="text" name="title" class="form-control" placeholder="Nom de l'événement" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-group-default">
                          <label>Date de Début</label>
                          <input id="editStartDate" type="datetime-local" name="start_date" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-group-default">
                          <label>Date de Fin</label>
                          <input id="editEndDate" type="datetime-local" name="end_date" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Description</label>
                          <input id="editDescription" type="text" name="description" class="form-control" placeholder="Description de l'événement" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Lieu</label>
                          <input id="editLocation" type="text" name="location" class="form-control" placeholder="Lieu de l'événement" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>max Participants</label>
                          <input id="editParticipants" type="text" name="max_participants" class="form-control" placeholder="Partcipants de l'événement" required />
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
                  <th>Nom de l'Événement</th>
                  <th>Date de Début</th>
                  <th>Date de Fin</th>
                  <th>Description</th>
                  <th>Lieu</th>
                  <th>Participants</th>

                  <th style="width: 10%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nom de l'Événement</th>
                  <th>Date de Début</th>
                  <th>Date de Fin</th>
                  <th>Description</th>
                  <th>Lieu</th>
                  <th>Participants</th>

                  <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach($events as $event)
                <tr>
                  <td>{{ $event->title }}</td>
                  <td>{{ $event->start_date }}</td>
                  <td>{{ $event->end_date }}</td>
                  <td>{{ $event->description }}</td>
                  <td>{{ $event->location }}</td>
                  <td>{{ $event->max_participants }}</td>

                  <td>
                    <div style="display: flex; align-items: center;">
                      <button
                        class="btn btn-link btn-primary"
                        title="Modifier l'Événement"
                        data-bs-toggle="modal"
                        data-bs-target="#editRowModal"
                        onclick="setEditEventData('{{ $event->id }}', '{{ $event->title }}', '{{ $event->start_date }}', '{{ $event->end_date }}', '{{ $event->description }}', '{{ $event->location }}','{{ $event->max_participants }}')">
                        <i class="fa fa-edit"></i>
                      </button>
                      <form action="{{ route('event.destroy', $event->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link btn-danger" title="Supprimer">
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
      $("#add-row").dataTable().fnAddData([
        $("#addName").val(),
        $("#addStartDate").val(),
        $("#addEndDate").val(),
        $("#addDescription").val(),
        $("#location").val(),
        $("#participants").val(),
        action
      ]);
      $("#addRowModal").modal("hide");
    });
  });


  function setEditEventData(id, title, start_date, end_date, description, location,max_participants) {
    document.getElementById('editEventForm').action = '/event/' + id;
    
    document.getElementById('editTitle').value = title;
    document.getElementById('editStartDate').value = start_date;
    document.getElementById('editEndDate').value = end_date;
    document.getElementById('editDescription').value = description;

    document.getElementById('editLocation').value = location;
    document.getElementById('editParticipants').value = max_participants;
  }
</script>
@endsection
