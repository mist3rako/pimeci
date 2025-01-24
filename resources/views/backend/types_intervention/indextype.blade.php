@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Planification</a></li>
            <li class="breadcrumb-item active" aria-current="page">Types d'Intervention</li>
        </ol>
    </nav>

    <!-- Afficher le bouton "Ajouter" uniquement pour les super admins -->
    @if(Auth::user()->role_as === 'super_admin')
        <a href="{{ route('types.intervention.createtype') }}" class="btn btn-info mb-3">Ajouter un Type d'Intervention</a>
    @endif

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        @if(Auth::user()->role_as === 'super_admin')
                            Liste de Tous les Types d'Intervention
                        @else
                            Types d'Intervention pour la Direction: {{ strtoupper(str_replace('admin_', '', Auth::user()->role_as)) }}
                        @endif
                    </h6>
                    <p class="text-muted mb-3">Vous pouvez ajouter, modifier ou supprimer des types.</p>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom du Type</th>
                                    <th>Direction</th>
                                    <th>Icône</th>
                                    <!-- Afficher la colonne Actions uniquement pour les super admins -->
                                    @if(Auth::user()->role_as === 'super_admin')
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($typeInterventions as $key => $type)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $type->nom_type_intervention }}</td>
                                    <td>{{ $type->dir_type_insp }}</td>
                                    <td>{{ $type->icons_champs_insp }}</td>
                                    <!-- Afficher les actions uniquement pour les super admins -->
                                    @if(Auth::user()->role_as === 'super_admin')
                                        <td>
                                            <a href="{{ route('types.intervention.edittype', $type->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('types.intervention.destroytype', $type->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
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
        // Vérifier si DataTable est déjà initialisé
        if ($.fn.DataTable.isDataTable('#dataTableExample')) {
            $('#dataTableExample').DataTable().destroy();
        }

        // Initialiser DataTable
        $('#dataTableExample').DataTable({
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Rechercher..."
            },
            "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            "order": [[ 0, "asc" ]],
            "paging": true,
            "info": true,
            "lengthChange": true
        });
    });
</script>
@endpush
