@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('types.intervention.indextype') }}">Types d'Intervention</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter un Type d'Intervention</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Ajouter un Type d'Intervention</h6>
                    <form action="{{ route('types.intervention.storetype') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nom_type_intervention">Nom du Type d'Intervention</label>
                            <input type="text" class="form-control" id="nom_type_intervention" name="nom_type_intervention" placeholder="Entrez le nom du type d'intervention" required>
                        </div>

                        <div class="form-group">
                            <label for="dir_type_insp">Direction</label>
                            <select class="form-control" id="dir_type_insp" name="dir_type_insp" required>
                                <option value="">Sélectionnez une direction</option>
                                <option value="DCQPC">DCQPC</option>
                                <option value="DCI">DCI</option>
                                <option value="DCRI">DCRI</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="icons_champs_insp">Icône (optionnelle)</label>
                            <input type="text" class="form-control" id="icons_champs_insp" name="icons_champs_insp" placeholder="Entrez le nom de l'icône">
                        </div>

                        <button type="submit" class="btn btn-info">Ajouter le Type d'Intervention</button>
                        <a href="{{ route('types.intervention.indextype') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
