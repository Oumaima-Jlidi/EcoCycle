@extends('Back.admin')
@section('content') 
<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Liste des Users</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="card-tools">
                <a href="{{ route('users.export.pdf') }}" class="btn btn-label-success btn-round btn-sm me-2">
        <span class="btn-label">
            <i class="fa fa-file-pdf"></i>
        </span>
        Exporter en PDF
    </a>
                      </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role ? $user->role->roleName : 'Aucun rôle' }}</td> 
            <td>
                <div style="display: flex; align-items: center;">
                    @if ($user->role && $user->role->roleName !== 'admin')
                    <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-link {{ $user->is_active ? 'btn-danger' : 'btn-success' }}" title="{{ $user->is_active ? 'Désactiver' : 'Activer' }}">
                <i class="fa {{ $user->is_active ? 'fa-toggle-off' : 'fa-toggle-on' }}"></i>
                {{ $user->is_active ? 'Désactiver' : 'Activer' }}
            </button>
        </form>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-danger" title="Supprimer">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                    @endif
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

<!-- Include your JS files here -->
<script src="../js/core/jquery-3.7.1.min.js"></script>
<script src="../js/core/popper.min.js"></script>
<script src="../js/core/bootstrap.min.js"></script>
<script src="../js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../js/plugin/datatables/datatables.min.js"></script>
<script src="../js/kaiadmin.min.js"></script>
<script src="../js/setting-demo2.js"></script>
<script>
    $(document).ready(function () {
        $("#add-row").DataTable({
            pageLength: 5,
        });
    });

    function setEditUserData(id, name, email, roleName) {
        // Mettre à jour l'action du formulaire
        document.getElementById('editRoleForm').action = '/user/' + id; // Assurez-vous que c'est la bonne URL

        // Remplir les champs du modal
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        // Si vous avez un champ pour le rôle, vous pouvez également le remplir ici
    }
</script>
@endsection
