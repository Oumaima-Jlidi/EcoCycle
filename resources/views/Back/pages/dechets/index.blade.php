@extends('Back.admin')
@section('content') 
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Liste des Déchets</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Ajouter Déchet</h4>
              <button
                class="btn btn-primary btn-round ms-auto"
                data-bs-toggle="modal"
                data-bs-target="#addRowModal"
              >
                <i class="fa fa-plus"></i>
                Ajouter Déchet
              </button>
            </div>
          </div>
          <div class="card-body">
            <!-- Modal for Adding Déchet -->
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
                      <span class="fw-mediumbold"> Ajouter un</span>
                      <span class="fw-light"> Déchet </span>
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
                      Créer un nouveau Déchet
                    </p>
                    <form action="{{ route('dechets.store') }}" method="POST">
                      @csrf 
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Type de Déchet</label>
                            <input
                              type="text"
                              name="type_dechet"
                              class="form-control"
                              placeholder="Type de Déchet"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Quantité de Déchet</label>
                            <input
                              type="number"
                              name="quantite"
                              class="form-control"
                              placeholder="Quantité de Déchet"
                              required
                              min="0"
  step="any" 
  title="Veuillez entrer un chiffre positif."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Origine du Déchet</label>
                            <input
                              type="text"
                              name="origine"
                              class="form-control"
                              placeholder="Origine du Déchet"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Date de Collecte</label>
                            <input
                              type="date"
                              name="date_collecte"
                              class="form-control"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Statut</label>
                            <input
                              type="text"
                              name="statut"
                              class="form-control"
                              placeholder="Statut"
                              required
                               pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
    <div class="form-group form-group-default">
        <label>Nom Collecte </label>
        <select
            id="editCollecteId"
            name="collecte_id"
            class="form-control"
            required
        >
            <option value="" disabled selected>Select Collecte</option>
            @foreach($collectes as $collecte)
                <option value="{{ $collecte->id }}">{{ $collecte->nom_collecte }}</option>
            @endforeach
        </select>
    </div>
</div>

                      </div>
                      <div class="modal-footer border-0">
                        <button
                          type="submit"
                          class="btn btn-primary"
                        >
                          Ajouter
                        </button>
                        <button
                          type="button"
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

            <!-- Modal for Editing Déchet -->
            <div
              class="modal fade"
              id="editRowModal"
              tabindex="-1"
              role="dialog"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header border-0">
                    <h5 class="modal-title">
                      <span class="fw-mediumbold">Modifier</span>
                      <span class="fw-light"> Déchet </span>
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
                      Modifier le déchet sélectionné
                    </p>
                    <form id="editDechetForm" action="" method="POST">
                      @csrf 
                      @method('PUT')
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Type de Déchet</label>
                            <input
                              id="editTypeDechet"
                              type="text"
                              name="type_dechet"
                              class="form-control"
                              placeholder="Type de Déchet"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Quantité de Déchet</label>
                            <input
                              id="editQuantite"
                              type="number"
                              name="quantite"
                              class="form-control"
                              placeholder="Quantité de Déchet"
                              required
                              min="0"
  step="any" 
  title="Veuillez entrer un chiffre positif."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Origine du Déchet</label>
                            <input
                              id="editOrigine"
                              type="text"
                              name="origine"
                              class="form-control"
                              placeholder="Origine du Déchet"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Date de Collecte</label>
                            <input
                              id="editDateCollecte"
                              type="date"
                              name="date_collecte"
                              class="form-control"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Statut</label>
                            <input
                              id="editStatut"
                              type="text"
                              name="statut"
                              class="form-control"
                              placeholder="Statut"
                              required
                               pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
  <div class="form-group form-group-default">
    <label>Nom Collecte </label>
    <select
      id="editCollecteId"
      name="collecte_id"
      class="form-control"
      required
    >
      <option value="" disabled selected>Select Collecte</option>
      @foreach($collectes as $collecte)
        <option value="{{ $collecte->id }}">{{ $collecte->nom_collecte }}</option>
      @endforeach
    </select>
  </div>
</div>

                      </div>
                      <div class="modal-footer border-0">
                        <button
                          type="submit"
                          class="btn btn-primary"
                        >
                          Mettre à jour
                        </button>
                        <button
                          type="button"
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
              <table
                id="add-row"
                class="display table table-striped table-hover"
              >
                <thead>
                  <tr>
                    <th>Type de Déchet</th>
                    <th>Quantité</th>
                    <th>Origine</th>
                    <th>Date de Collecte</th>
                    <th>Statut</th>
                    <th>Nom Collecte </th>
                    <th style="width: 10%">Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Type de Déchet</th>
                    <th>Quantité</th>
                    <th>Origine</th>
                    <th>Date de Collecte</th>
                    <th>Statut</th>
                    <th>Nom Collecte </th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($dechets as $dechet)
                    <tr>
                      <td>{{ $dechet->type_dechet }}</td>
                      <td>{{ $dechet->quantite }}</td>
                      <td>{{ $dechet->origine }}</td>
                      <td>{{ $dechet->date_collecte }}</td>
                      <td>{{ $dechet->statut }}</td>
                      <td>{{ $dechet->collecte->nom_collecte }}</td>
                      <td>
                        <div class="form-button-action">
                          <button
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#editRowModal"
                            class="btn btn-link btn-primary btn-lg"
                            onclick="setEditModalValues({{ json_encode($dechet) }})"
                          >
                            <i class="fa fa-edit"></i>
                          </button>
                          <form
                            action="{{ route('dechets.destroy', $dechet->id) }}"
                            method="POST"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce déchet ?');"
                          >
                            @csrf
                            @method('DELETE')
                            <button
                              type="submit"
                              class="btn btn-link btn-danger"
                            >
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

  <script>
    function setEditModalValues(dechet) {
      document.getElementById('editTypeDechet').value = dechet.type_dechet;
      document.getElementById('editQuantite').value = dechet.quantite;
      document.getElementById('editOrigine').value = dechet.origine;
      document.getElementById('editDateCollecte').value = dechet.date_collecte;
      document.getElementById('editStatut').value = dechet.statut;
      document.getElementById('editCollecteId').value = dechet.collecte_id;
      document.getElementById('editDechetForm').action = `/dechets/${dechet.id}`;
    }
  </script>
@endsection
