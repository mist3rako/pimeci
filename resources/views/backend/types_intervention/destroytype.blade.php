@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('types.intervention.indextype') }}">Types d'Intervention</a></li>
            <li class="breadcrumb-item active" aria-current="page">Supprimer le Type d'Intervention</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Supprimer le Type d'Intervention</h6>
                    <p class="text-muted mb-3">Êtes-vous sûr de vouloir supprimer le type d'intervention suivant ? Cette action est irréversible.</p>

                    <ul>
                        <li><strong>Nom du Type:</strong> {{ $typeIntervention->nom_type_intervention }}</li>
                        <li><strong>Direction:</strong> {{ $typeIntervention->dir_type_insp }}</li>
                        <li><strong>Icône:</strong> {{ $typeIntervention->icons_champs_insp ?? 'N/A' }}</li>
                    </ul>

                    <form action="{{ route('types.intervention.destroytype', $typeIntervention->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" id="delete" data-url="{{ route('types.intervention.destroytype', $typeIntervention->id) }}">Supprimer</button>
                        <a href="{{ route('types.intervention.indextype') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
