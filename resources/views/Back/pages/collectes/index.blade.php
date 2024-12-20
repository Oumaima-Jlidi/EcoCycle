@extends('Back.admin')
@section('content') 
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Liste des Collectes</h3> 
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Ajouter Collecte</h4>
              <button id="exportButton" class="btn btn-success" onclick="exportTableToPDF()">Exporter en PDF</button>
              <button
                class="btn btn-primary btn-round ms-auto"
                data-bs-toggle="modal"
                data-bs-target="#addRowModal"
              >
                <i class="fa fa-plus"></i>
                Ajouter Collecte 
              </button>
            </div>
          </div>
          <div class="card-body">
            <!-- Modal for Adding Collecte -->
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
                      <span class="fw-mediumbold"> Ajouter une</span>
                      <span class="fw-light"> Collecte </span>
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
                      Créer une nouvelle Collecte
                    </p>
                    <form action="{{ route('collectes.store') }}" method="POST">
                      @csrf 
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Nom collecte</label>
                            <input
                              type="text"
                              name="nom_collecte"
                              class="form-control"
                              placeholder="Nom collecte"
                              required
                               pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Zone de Collecte</label>
                            <input
                              type="text"
                              name="zone_collecte"
                              class="form-control"
                              placeholder="Zone de Collecte"
                              required
                              pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
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
                            <label>Quantité de Collecte</label>
                            <input
                              type="number"
                              name="quantite_collecte"
                              class="form-control"
                              placeholder="Quantité de Collecte"
                              required
                              min="0"
  step="any"
  title="Veuillez entrer un chiffre positif."
                            />
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

            <!-- Modal for Editing Collecte -->
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
                      <span class="fw-light"> Collecte </span>
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
                      Modifier la collecte sélectionnée
                    </p>
                    <form id="editCollecteForm" action="" method="POST">
                      @csrf 
                      @method('PUT')
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Nom collecte</label>
                            <input
                              id="editTypeDechet"
                              type="text"
                              name="nom_collecte"
                              class="form-control"
                              placeholder="Nom collecte"
                              required
                               pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Zone de Collecte</label>
                            <input
                              id="editZoneCollecte"
                              type="text"
                              name="zone_collecte"
                              class="form-control"
                              placeholder="Zone de Collecte"
                              required
                               pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
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
                            <label>Quantité de Collecte</label>
                            <input
                              id="editQuantiteCollecte"
                              type="number"
                              name="quantite_collecte"
                              class="form-control"
                              placeholder="Quantité de Collecte"
                              required
                              min="0"
  step="any" 
  title="Veuillez entrer un chiffre positif."
                            />
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

 

            <!--affiche tableau -->




            <div class="table-responsive">
              <table
                id="add-row"
                class="display table table-striped table-hover"
              >
                <thead>
                  <tr>
                    <th>Nom collecte</th>
                    <th>Zone de Collecte</th>
                    <th>Statut</th>
                    <th>Date de Collecte</th>
                    <th>Quantité de Collecte</th>
                    <th style="width: 10%">Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Nom collecte</th>
                    <th>Zone de Collecte</th>
                    <th>Statut</th>
                    <th>Date de Collecte</th>
                    <th>Quantité de Collecte</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($collectes as $collecte)
                    <tr>
                      <td>{{ $collecte->nom_collecte }}</td>
                      <td>{{ $collecte->zone_collecte }}</td>
                      <td>{{ $collecte->statut }}</td>
                      <td>{{ $collecte->date_collecte }}</td>
                      <td>{{ $collecte->quantite_collecte }}</td>
                      <td>
                        <div style="display: flex; align-items: center;">
                          <button
                            class="btn btn-link btn-primary"
                            title="Modifier la Collecte"
                            data-bs-toggle="modal"
                            data-bs-target="#editRowModal"
                            onclick="setEditCollecteData('{{ $collecte->id }}', '{{ $collecte->nom_collecte }}', '{{ $collecte->zone_collecte }}', '{{ $collecte->statut }}', '{{ $collecte->date_collecte }}', '{{ $collecte->quantite_collecte }}')"
                          >
                            <i class="fa fa-edit"></i>
                          </button>
                          <form action="{{ route('collectes.destroy', $collecte->id) }}" method="POST" style="margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-danger" title="Supprimer la Collecte">
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

  <!-- script pdf -->
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>



<script>
  async function exportTableToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Titre du document
    doc.setFontSize(20);
    doc.text("Liste des Collectes", 14, 22);

    // Récupération des données du tableau
    const table = document.getElementById("add-row");
    const rows = table.getElementsByTagName("tr");
    const data = [];

    // Récupérer les en-têtes
    const headers = Array.from(rows[0].querySelectorAll("th")).map(th => th.innerText);
    data.push(headers.slice(0, -1)); // Ajouter les en-têtes au tableau des données (ignorer le dernier)

    // Parcours des lignes du tableau pour extraire les données
    for (let i = 1; i < rows.length; i++) { // Commencez à 1 pour ignorer l'en-tête
      const cols = rows[i].getElementsByTagName("td");
      const rowData = [];
      for (let j = 0; j < cols.length; j++) {
        if (j < cols.length - 1) { // Ignorer la dernière colonne "Action"
          rowData.push(cols[j].innerText); // Ajouter le texte de chaque cellule sauf "Action"
        }
      }
      data.push(rowData); // Ajouter les données de la ligne au tableau
    }

    // Ajout des données au PDF
    doc.autoTable({
      head: [data[0]], // En-têtes
      body: data.slice(1), // Données (ignorer la première ligne qui contient les en-têtes)
      startY: 30, // Positionnement vertical
    });

    // Génération du PDF
    doc.save("collectes.pdf");
  }
</script>




  <script>
    function setEditCollecteData(id, typeDechet, zoneCollecte, statut, dateCollecte, quantiteCollecte) {
      document.getElementById('editCollecteForm').action = '/collectes/' + id; // Set the form action URL
      document.getElementById('editTypeDechet').value = typeDechet; // Set the type dechet input
      document.getElementById('editZoneCollecte').value = zoneCollecte; // Set the zone collecte input
      document.getElementById('editStatut').value = statut; // Set the statut input
      document.getElementById('editDateCollecte').value = dateCollecte; // Set the date collecte input
      document.getElementById('editQuantiteCollecte').value = quantiteCollecte; // Set the quantite collecte input
    }
  </script>
@endsection
