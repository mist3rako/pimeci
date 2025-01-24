@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Planification</a></li>
            <li class="breadcrumb-item active" aria-current="page">Champs d'Inspection</li>
        </ol>
    </nav>

    <!-- Afficher le bouton "Ajouter" uniquement pour les super admins -->
    @if(Auth::user()->role_as === 'super_admin')
        <a href="{{ route('champs.inspection.create') }}" class="btn btn-info mb-3">Ajouter un Champ d'Inspection</a>
    @endif

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        @if(Auth::user()->role_as === 'super_admin')
                            Liste de Tous les Champs d'Inspection
                        @else
                            Champs d'Inspection pour la Direction: {{ strtoupper(str_replace('admin_', '', Auth::user()->role_as)) }}
                        @endif
                    </h6>
                    <p class="text-muted mb-3">Voici la liste complète des champs d'inspection.</p>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom du Champ</th>
                                    <th>Description</th>
                                    <th>Direction</th>
                                    <th>Icône</th>
                                    <!-- Afficher la colonne Actions uniquement pour les super admins -->
                                    @if(Auth::user()->role_as === 'super_admin')
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($champsInspections as $key => $champ)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $champ->nom_champs }}</td>
                                    <td>{{ $champ->champs_descr }}</td>
                                    <td>{{ $champ->dir_champs_insp }}</td>
                                    <td>
                                        @if($champ->icons_champs_insp)
                                            <img src="{{ asset('path/to/icons/' . $champ->icons_champs_insp) }}" alt="Icone" width="30">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <!-- Afficher les actions uniquement pour les super admins -->
                                    @if(Auth::user()->role_as === 'super_admin')
                                        <td>
                                            <a href="{{ route('champs.inspection.edit', $champ->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('champs.inspection.destroy', $champ->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" id="delete">Supprimer</button>
                                            </form>
                                        </td>
                                    @endif
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

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Vérifier si le tableau DataTable est déjà initialisé
        if ($.fn.DataTable.isDataTable('#dataTableExample')) {
            // Détruire l'instance précédente de DataTable
            $('#dataTableExample').DataTable().destroy();
        }

        // Initialiser le tableau DataTable
        $('#dataTableExample').DataTable({
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Rechercher..."
            },
            "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            "order": [[0, "asc"]],
            "paging": true,
            "info": true,
            "lengthChange": true
        });
    });
</script>
@endpush
