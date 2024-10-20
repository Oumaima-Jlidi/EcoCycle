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
          <!-- <div class="d-flex align-items-center">
            <h4 class="card-title">Ajouter Feedback</h4>
            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
              <i class="fa fa-plus"></i> Ajouter Feedback
            </button>
          </div> -->
        </div>
        <div class="card-body">
          <!-- Modal add -->
          <!-- <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <h5 class="modal-title"> Ajouter un Événement </h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('event.store') }}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Nom de l'Événement</label>
                          <input type="text" name="title" class="form-control" placeholder="Nom de l'événement" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-group-default">
                          <label>Date de Début</label>
                          <input type="datetime-local" name="start_date" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-group-default">
                          <label>Date de Fin</label>
                          <input type="datetime-local" name="end_date" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Description</label>
                          <input type="text" name="description" class="form-control" placeholder="Description" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Lieu</label>
                          <input type="text" name="location" class="form-control" placeholder="Lieu" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Max Participants</label>
                          <input type="number" name="max_participants" class="form-control" placeholder="Participants" required />
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer border-0">
                      <button type="submit" class="btn btn-primary">Ajouter</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div> -->



          <!-- Modal update -->
          <!-- <div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header border-0">
                  <h5 class="modal-title">Modifier l'Événement</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="editEventForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Nom de l'Événement</label>
                          <input id="editTitle" type="text" name="title" class="form-control" required />
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
                          <input id="editDescription" type="text" name="description" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Lieu</label>
                          <input id="editLocation" type="text" name="location" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group form-group-default">
                          <label>Max Participants</label>
                          <input id="editMaxParticipants" type="number" name="max_participants" class="form-control" required />
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer border-0">
                      <button type="submit" class="btn btn-primary">Mettre à jour</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div> -->

          <!-- Table -->
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
//   function setEditEventData(event) {
    
//     document.getElementById('editEventForm').action = '/event/' + event.id;
//     document.getElementById('editTitle').value = event.title;
//     document.getElementById('editStartDate').value = event.start_date;
//     document.getElementById('editEndDate').value = event.end_date;
//     document.getElementById('editDescription').value = event.description;
//     document.getElementById('editLocation').value = event.location;
//     document.getElementById('editMaxParticipants').value = event.max_participants;
//   }
</script>

@endsection