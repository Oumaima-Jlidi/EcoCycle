@extends('Back.admin')
@section('content') 
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Liste des Articles</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Ajouter Artiicle</h4>
              <button
                class="btn btn-primary btn-round ms-auto"
                data-bs-toggle="modal"
                data-bs-target="#addRowModal"
              >
                <i class="fa fa-plus"></i>
                Ajouter Article
              </button>
            </div>
          </div>
          <div class="card-body">
            <!-- Modal for Adding Article -->
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
                      <span class="fw-light"> Article </span>
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
                      Créer un nouveau Article
                    </p>
                    <form action="{{ route('articles.store') }}" method="POST">
                      @csrf 
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Nom Article</label>
                            <input
                              type="text"
                              name="titre"
                              class="form-control"
                              placeholder="Nom article"
                              required
                               pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Contenu</label>
                            <input
                              type="text"
                              name="contenu"
                              class="form-control"
                              placeholder="contenu article"
                              required
                              pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Nom_auteur</label>
                            <input
                              type="text"
                              name="Nom_auteur"
                              class="form-control"
                              placeholder="Nom_auteur"
                              required
                               pattern="[A-Za-zÀ-ÿ\s]+"
  title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."
                            />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Date_publication</label>
                            <input
                              type="date"
                              name="date_publication"
                              class="form-control"
                              required
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
<!-- Modal pour Modifier l'Article -->
<div class="modal fade" id="editRowModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title"><span class="fw-mediumbold">Modifier</span><span class="fw-light"> Article </span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="small">Modifier l'article sélectionné</p>
        <form id="editArticleForm" action="" method="POST">
          @csrf 
          @method('PUT')
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group form-group-default">
                <label>Nom Article</label>
                <input id="editTitre" type="text" name="titre" class="form-control" placeholder="Nom article" required pattern="[A-Za-zÀ-ÿ\s]+" title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."/>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group form-group-default">
                <label>Contenu</label>
                <textarea id="editContenu" name="contenu" class="form-control" placeholder="Contenu article" required></textarea>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group form-group-default">
                <label>Nom Auteur</label>
                <input id="editNom_auteur" type="text" name="Nom_auteur" class="form-control" placeholder="Nom auteur" required pattern="[A-Za-zÀ-ÿ\s]+" title="Veuillez entrer uniquement des caractères alphabétiques et des espaces."/>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group form-group-default">
                <label>Date de Publication</label>
                <input id="editDate_publication" type="date" name="date_publication" class="form-control" required/>
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
                class="display table table-striped table-hover"
              >
                <thead>
                  <tr>
                    <th>Nom Article</th>
                    <th>Contenu</th>
                    <th>Nom_auteur </th>
                    <th>Date de publication</th>
                    
                    <th style="width: 10%">Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th>Nom Article</th>
                    <th>Contenu</th>
                    <th>Nom_auteur </th>
                    <th>Date de publication</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach($articles as $article)
                    <tr>
                      <td>{{ $article->titre }}</td>
                      <td>{{ $article->contenu }}</td>
                      <td>{{ $article->Nom_auteur }}</td>
                      <td>{{ $article->date_publication }}</td>
                    
                      <td>
                        <div style="display: flex; align-items: center;">
                          <button
                            class="btn btn-link btn-primary"
                            title="Modifier l Article"
                            data-bs-toggle="modal"
                            data-bs-target="#editRowModal"
                            onclick="setEditArticleData('{{ $article->id }}', '{{ $article->titre }}', '{{ $article->contenu }}', '{{ $article->Nom_auteur }}', '{{ $article->date_publication }}',)"
                          >
                            <i class="fa fa-edit"></i>
                          </button>
                          <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-danger" title="Supprimer la Article">
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
function setEditArticleData(id, titre, contenu, Nom_auteur , date_publication) {
    // Met à jour l'action du formulaire d'édition avec l'ID spécifique de l'article
    document.getElementById('editArticleForm').action = '/articles/' + id;

    // Pré-remplit le champ "titre" avec la valeur actuelle de l'article
    document.getElementById('editTitre').value = titre; // Modifié

    // Pré-remplit le champ "contenu" avec la valeur actuelle de l'article
    document.getElementById('editContenu').value = contenu;

    // Pré-remplit le champ "Nom de l'auteur" avec la valeur actuelle de l'article
    document.getElementById('editNom_auteur').value = Nom_auteur ;

    // Pré-remplit le champ "date de publication" avec la valeur actuelle de l'article
    document.getElementById('editDate_publication').value = date_publication; // Modifié
}
</script>

@endsection
