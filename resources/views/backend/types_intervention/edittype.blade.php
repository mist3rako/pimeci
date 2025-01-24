@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('types.intervention.indextype') }}">Types d'Intervention</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier un Type d'Intervention</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Modifier un Type d'Intervention</h6>
                    <form action="{{ route('types.intervention.updatetype', $typeIntervention->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="nom_type_intervention">Nom du Type d'Intervention</label>
                            <input type="text" class="form-control" id="nom_type_intervention" name="nom_type_intervention" value="{{ $typeIntervention->nom_type_intervention }}" required>
                        </div>

                        <div class="form-group">
                            <label for="dir_type_insp">Direction</label>
                            <select class="form-control" id="dir_type_insp" name="dir_type_insp" required>
                                <option value="">Sélectionnez une direction</option>
                                <option value="DCQPC" {{ $typeIntervention->dir_type_insp == 'DCQPC' ? 'selected' : '' }}>DCQPC</option>
                                <option value="DCI" {{ $typeIntervention->dir_type_insp == 'DCI' ? 'selected' : '' }}>DCI</option>
                                <option value="DCRI" {{ $typeIntervention->dir_type_insp == 'DCRI' ? 'selected' : '' }}>DCRI</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="icons_champs_insp">Icône (optionnelle)</label>
                            <input type="text" class="form-control" id="icons_champs_insp" name="icons_champs_insp" value="{{ $typeIntervention->icons_champs_insp }}">
                        </div>

                        <button type="submit" class="btn btn-warning">Mettre à jour le Type d'Intervention</button>
                        <a href="{{ route('types.intervention.indextype') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
