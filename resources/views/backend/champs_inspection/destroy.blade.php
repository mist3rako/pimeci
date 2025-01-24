@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('champs.inspection.index') }}">Champs d'inspection</a></li>
            <li class="breadcrumb-item active" aria-current="page">Supprimer le Champ d'Inspection</li>
        </ol>
    </nav>

    <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Supprimer le Champ d'Inspection</h6>

                    <p class="text-warning mb-4">Êtes-vous sûr de vouloir supprimer ce champ d'inspection ? Cette action est irréversible.</p>

                    <form action="{{ route('champs.inspection.destroy', $champsInspection->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="nom_champs" class="form-label">Nom du Champ</label>
                            <input type="text" class="form-control" id="nom_champs" name="nom_champs" value="{{ $champsInspection->nom_champs }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="champs_descr" class="form-label">Description du Champ</label>
                            <textarea class="form-control" id="champs_descr" name="champs_descr" rows="4" disabled>{{ $champsInspection->champs_descr }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-danger me-2">Supprimer</button>
                        <a href="{{ route('champs.inspection.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
