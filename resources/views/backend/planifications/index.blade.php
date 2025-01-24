@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">

    <!-- Breadcrumb -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gestion des Planifications</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Liste des Planifications</h6>
                    <p class="text-muted mb-3">Utilisez le tableau ci-dessous pour visualiser, filtrer et gérer vos planifications.</p>

                    <!-- Afficher un message pour les administrateurs spécifiques -->
                    @if(Auth::user()->role_as == 'admin_dci' || Auth::user()->role_as == 'admin_dcri' || Auth::user()->role_as == 'admin_dcqpc')
    <div class="alert alert-info">
        Vous visualisez uniquement les planifications que vous avez créées.
    </div>
@endif

                    <!-- Bouton Ajouter une Planification -->
                    <div class="text-right mb-4">
                        <a href="{{ route('planifications.create') }}" class="btn btn-primary">Ajouter une Planification</a>
                    </div>

                    <!-- Table des planifications -->
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code de Planification</th>
                                    <th>Planificateur</th>
                                    <th>Inspecteurs</th>
                                    <th>Entreprise</th>
                                    <th>Type d'Intervention</th>
                                    <th>Champ d'Inspection</th>
                                    <th>Statut</th>
                                    <th>Date de Planification</th>
                                    <th>Date d'Inspection</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($planifications as $key => $planification)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $planification->plan_mission_code }}</td>
                                        <td>{{ optional($planification->planificateurUser)->nom ?? '' }} {{ optional($planification->planificateurUser)->prenom ?? '' }}</td>
                                        <td>
                                            <strong>Chef de Brigade :</strong> {{ optional($planification->chefDeBrigade)->nom ?? 'N/A' }} {{ optional($planification->chefDeBrigade)->prenom ?? '' }}
                                            <br>
                                            @if($planification->id_users2)
                                                <small class="text-muted">2e Inspecteur: {{ optional($planification->idUsers2)->nom ?? '' }} {{ optional($planification->idUsers2)->prenom ?? '' }}</small><br>
                                            @endif
                                            @if($planification->id_users3)
                                                <small class="text-muted">3e Inspecteur: {{ optional($planification->idUsers3)->nom ?? '' }} {{ optional($planification->idUsers3)->prenom ?? '' }}</small><br>
                                            @endif
                                            @if($planification->id_users4)
                                                <small class="text-muted">4e Inspecteur: {{ optional($planification->idUsers4)->nom ?? '' }} {{ optional($planification->idUsers4)->prenom ?? '' }}</small>
                                            @endif
                                        </td>
                                        <td>{{ optional($planification->entreprise)->nom_entreprise ?? 'N/A' }}</td>
                                        <td>{{ optional($planification->typeIntervention)->nom_type_intervention ?? 'N/A' }}</td>
                                        <td>{{ optional($planification->champsInspection)->nom_champs ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge text-white" style="
                                                @if($planification->plan_progress_statut == 'Planifié') background-color: #007bff;  
                                                @elseif($planification->plan_progress_statut == 'En cours') background-color: #ffc107;  
                                                @elseif($planification->plan_progress_statut == 'Complète') background-color: #28a745;  
                                                @else background-color: #dc3545;  
                                                @endif">
                                                {{ $planification->plan_progress_statut }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($planification->created_at)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($planification->date_inspection)->format('d F Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('planifications.show', $planification->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            @if($planification->plan_progress_statut == 'Planifié')
                                                <a href="{{ route('planifications.edit', $planification->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('planifications.destroy', $planification->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette planification ?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Ajout des liens de pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $planifications->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div> <!-- Fin de la table responsive -->
                </div> <!-- Fin de la carte -->
            </div> <!-- Fin de la colonne -->
        </div> <!-- Fin de la rangée -->
    </div> <!-- Fin du contenu de la page -->
</div> <!-- Fin du contenu de la page -->
@endsection

<!-- Inclusion de DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

<!-- Script de DataTable -->
<script>
    $(document).ready(function() {
        $('#dataTableExample').DataTable({
            "paging": false, // Désactiver la pagination de DataTables
            "searching": true,
            "info": false,
            "lengthChange": false,
            "language": {
                "zeroRecords": "Aucune planification trouvée",
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
