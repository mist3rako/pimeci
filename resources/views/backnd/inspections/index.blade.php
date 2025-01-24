@extends('inspecteur.inspecteur_dashboard')

@section('inspecteur')
<div class="container">
    <h1>Mes Inspections</h1>

    <div class="mb-3">
        <form action="{{ route('inspecteur.inspections.index') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Rechercher par code d'inspection ou entreprise..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </form>
    </div>

    <table class="table" id="dataTableExample">
        <thead>
            <tr>
                <th><strong>Code Inspection</strong></th>
                <th><strong>Entreprise</strong></th>
                <th><strong>Type d'Intervention</strong></th>
                <th><strong>Date d'Inspection</strong></th>
                <th><strong>Statut</strong></th>
                <th><strong>Planificateur</strong></th>
                <th><strong>Chef de Brigade</strong></th>
                <th><strong>Inspecteurs Assignés</strong></th>
                <th><strong>Actions</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach($inspections as $inspection)
                <tr>
                    <td style="font-size: 12px;">{{ $inspection->plan_mission_code }}</td>
                    <td style="font-size: 12px;">{{ optional($inspection->entreprise)->nom_entreprise }}</td>
                    <td style="font-size: 12px;">{{ optional($inspection->typeIntervention)->nom_type_intervention ?? 'N/A' }}</td>
                    <td style="font-size: 12px;">
                        {{ $inspection->date_inspection ? $inspection->date_inspection->translatedFormat('d F Y') : 'N/A' }}<br>
                        <small>{{ $inspection->date_inspection ? $inspection->date_inspection->translatedFormat('h:i A') : 'N/A' }}</small>
                    </td>
                    <td>
                        @switch($inspection->plan_progress_statut)
                            @case('Complète')
                                <span class="badge bg-success">{{ $inspection->plan_progress_statut }}</span>
                                @break

                            @case('En cours')
                                <span class="badge bg-warning text-dark">{{ $inspection->plan_progress_statut }}</span>
                                @break

                            @case('Expiré')
                                <span class="badge bg-danger">{{ $inspection->plan_progress_statut }}</span>
                                @break

                            @case('Planifié')
                                <span class="badge bg-primary">{{ $inspection->plan_progress_statut }}</span>
                                @break

                            @default
                                <span class="badge bg-secondary">{{ $inspection->plan_progress_statut }}</span>
                        @endswitch
                    </td>
                    <td style="font-size: 12px;">{{ optional($inspection->planificateurUser)->nom . ' ' . optional($inspection->planificateurUser)->prenom ?? 'N/A' }}</td>
                    <td style="font-size: 12px;">{{ optional($inspection->chefDeBrigade)->nom . ' ' . optional($inspection->chefDeBrigade)->prenom ?? 'N/A' }}</td>
                    <td style="font-size: 10px;">
                        <ul>
                            @if($inspection->idUsers2 || $inspection->idUsers3 || $inspection->idUsers4)
                                @if($inspection->idUsers2)
                                    <li>{{ optional($inspection->idUsers2)->nom . ' ' . optional($inspection->idUsers2)->prenom }}</li>
                                @endif
                                @if($inspection->idUsers3)
                                    <li>{{ optional($inspection->idUsers3)->nom . ' ' . optional($inspection->idUsers3)->prenom }}</li>
                                @endif
                                @if($inspection->idUsers4)
                                    <li>{{ optional($inspection->idUsers4)->nom . ' ' . optional($inspection->idUsers4)->prenom }}</li>
                                @endif
                            @else
                                <li>Aucun autre inspecteur assigné</li>
                            @endif
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('inspecteur.inspections.show', $inspection->id) }}" class="btn btn-sm btn-primary me-3">
                            Voir Détails
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2C6.48 2 2 6.48 2 12c0 5.52 4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm0-4h-2V7h2v8z" fill="black"/>
                                </svg>
                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $inspections->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
</div>

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

@endsection 
