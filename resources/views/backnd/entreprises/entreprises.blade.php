@extends('inspecteur.inspecteur_dashboard')

@section('inspecteur')

<div class="container">
    <!-- Breadcrumb Navigation -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inspecteur.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item active" aria-current="page">Liste des Entreprises</li>
        </ol>
    </nav>

    <!-- Card for Liste des Entreprises -->
    <div class="card mb-5 mb-xl-8">
        <!-- Card Header -->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Liste des Entreprises</span>
                <span class="text-muted mt-1 fw-bold fs-7">Gérez toutes les entreprises</span>
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Ajouter une entreprise">
                <a href="{{ route('entreprise.create') }}" class="btn btn-sm btn-light btn-active-primary">
                    <!-- SVG Icon pour ajouter -->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"/>
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"/>
                        </svg>
                    </span>
                    Ajouter une Entreprise
                </a>
            </div>
        </div>
        <!-- End Card Header -->

        <!-- Card Body -->
        <div class="card-body py-3">
            <!-- Affichage des messages de succès -->
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Table des entreprises -->
            <div class="table-responsive">
                <table class="table table-bordered table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="entreprisesTable">
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th class="min-w-50px text-center">#</th>
                            <th class="min-w-150px">Code Entreprise</th>
                            <th class="min-w-150px">Nom</th>
                            <th class="min-w-150px">Secteur d'Activité</th>
                            <th class="min-w-200px">Adresse</th>
                            <th class="min-w-150px">Rue</th>
                            <th class="min-w-150px text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entreprises as $entreprise)
                            <tr>
                                <!-- ID de l'entreprise -->
                                <td class="text-center">{{ $entreprise->id }}</td>
                                
                                <!-- Code de l'entreprise -->
                                <td>{{ $entreprise->code_entreprise }}</td>
                                
                                <!-- Nom de l'entreprise -->
                                <td>{{ $entreprise->nom_entreprise }}</td>
                                
                                <!-- Secteur d'Activité -->
                                <td>
                                    {{ $entreprise->secteurActivite ? $entreprise->secteurActivite->nom_secteur : 'N/A' }}
                                </td>
                                
                                <!-- Adresse (département, commune) -->
                                <td>
                                    @if($entreprise->adresse)
                                        {{ $entreprise->adresse->departement }}, {{ $entreprise->adresse->commune }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                
                                <!-- Rue -->
                                <td>
                                    {{ $entreprise->rue }}
                                </td>
                                
                                <!-- Actions -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <!-- Bouton Modifier -->
                                        <a href="{{ route('entreprises.edit', $entreprise->id) }}" class="btn btn-sm btn-warning me-2" title="Modifier">
                                            <span class="svg-icon svg-icon-3">
                                                <!-- SVG Icon pour Modifier -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M7 21H17C18.1046 21 19 20.1046 19 19V5C19 3.89543 18.1046 3 17 3H7C5.89543 3 5 3.89543 5 5V19C5 20.1046 5.89543 21 7 21Z" fill="black"/>
                                                    <path d="M7 3C6.44772 3 6 3.44772 6 4C6 4.55228 6.44772 5 7 5H17C17.5523 5 18 4.55228 18 4C18 3.44772 17.5523 3 17 3H7Z" fill="black"/>
                                                    <path d="M12 9C12.5523 9 13 8.55228 13 8C13 7.44772 12.5523 7 12 7C11.4477 7 11 7.44772 11 8C11 8.55228 11.4477 9 12 9Z" fill="black"/>
                                                    <path d="M8 11H16V13H8V11Z" fill="black"/>
                                                </svg>
                                            </span>
                                        </a>

                                        <!-- Bouton Supprimer -->
                                        <form action="{{ route('entreprises.destroy', $entreprise->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                <span class="svg-icon svg-icon-3">
                                                    <!-- SVG Icon pour Supprimer -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M6 19C6 20.1046 6.89543 21 8 21H16C17.1046 21 18 20.1046 18 19V7H6V19Z" fill="black"/>
                                                        <path d="M19 4H15L14 3H10L9 4H5V6H19V4Z" fill="black"/>
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Aucune entreprise trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Fin Table -->

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $entreprises->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <!-- End Card Body -->
    </div>
    <!-- End Card -->
</div>

<!-- Script de DataTable (Optionnel) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#entreprisesTable').DataTable({
            "paging": false, // Désactive la pagination de DataTables si vous utilisez Laravel Pagination
            "searching": true,
            "info": false,
            "lengthChange": false,
            "language": {
                "zeroRecords": "Aucune entreprise trouvée",
                "search": "Rechercher:",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            }
        });
    });
</script>

@endsection
