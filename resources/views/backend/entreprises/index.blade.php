@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item active" aria-current="page">Liste des Entreprises</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Entreprises</h6>

                    <!-- Affichage des messages de succès -->
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <!-- Boutons pour créer une nouvelle entreprise et ajouter via DAJ -->
                    <div class="mb-3">
                        <a href="{{ route('entreprises.create') }}" class="btn btn-primary">Ajouter une Entreprise</a>
                        <button class="btn btn-secondary" id="openDajModal">Ajouter Via DAJ</button>
                    </div>

                    <!-- Table des entreprises -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code Entreprise</th>
                                    <th>Nom</th>
                                    <th>Secteur d'Activité</th>
                                    <th>Adresse</th>
                                    <th>Rue</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entreprises as $entreprise)
                                    <tr>
                                        <td>{{ $entreprise->id }}</td>
                                        <td>{{ $entreprise->code_entreprise }}</td>
                                        <td>{{ $entreprise->nom_entreprise }}</td>
                                        <td>{{ $entreprise->secteurActivite ? $entreprise->secteurActivite->nom_secteur : 'N/A' }}</td>
                                        <td>{{ $entreprise->adresse ? $entreprise->adresse->departement . ', ' . $entreprise->adresse->commune : $entreprise->rue }}</td>
                                        <td>{{ $entreprise->rue }}</td>
                                        <td>
                                            <!-- Boutons d'actions -->
                                            <a href="{{ route('entreprises.edit', $entreprise->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                            <a href="{{ route('entreprises.confirmDelete', $entreprise->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">Supprimer</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $entreprises->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lightbox pour la recherche DAJ -->
<div id="dajModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dajModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dajModalLabel">Recherche d'Entreprise via DAJ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dajSearchForm">
                    <div class="form-group">
                        <label for="dajSearchInput">Rechercher une entreprise</label>
                        <input type="text" class="form-control" id="dajSearchInput" placeholder="Entrez le nom ou le code de l'entreprise">
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
                <div id="dajSearchResults" class="mt-3">
                    <!-- Les résultats de la recherche seront affichés ici -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Script pour la gestion du modal et la recherche -->
<script>
    document.getElementById('openDajModal').addEventListener('click', function() {
        $('#dajModal').modal('show');
    });

    // Simulation de recherche
    document.getElementById('dajSearchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var searchInput = document.getElementById('dajSearchInput').value;

        // Simuler des résultats de recherche (cela sera remplacé par un appel à l'API plus tard)
        var results = `
            <ul>
                <li>Résultat 1 pour "${searchInput}" 
                    <button class="btn btn-success btn-sm ml-2" onclick="addEnterprise('Résultat 1')">Ajouter</button>
                </li>
                <li>Résultat 2 pour "${searchInput}" 
                    <button class="btn btn-success btn-sm ml-2" onclick="addEnterprise('Résultat 2')">Ajouter</button>
                </li>
            </ul>
        `;
        document.getElementById('dajSearchResults').innerHTML = results;
    });

    // Fonction simulée pour ajouter une entreprise
    function addEnterprise(enterpriseName) {
        alert(enterpriseName + ' a été ajouté avec succès !');
        // Ici, vous ajouteriez une requête Ajax pour envoyer l'information à votre backend
        $('#dajModal').modal('hide');
    }
</script>

@endsection
