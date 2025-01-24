@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('champs.inspection.index') }}">Champs d'inspection</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter un Champ d'Inspection</li>
        </ol>
    </nav>

    <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Ajouter un Champ d'Inspection</h6>

                    <form class="forms-sample" action="{{ route('champs.inspection.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nom_champs" class="form-label">Nom du Champ</label>
                            <input type="text" class="form-control" id="nom_champs" name="nom_champs" placeholder="Entrez le nom du champ" required>
                        </div>

                        <div class="mb-3">
                            <label for="champs_descr" class="form-label">Description du Champ</label>
                            <textarea class="form-control" id="champs_descr" name="champs_descr" rows="4" placeholder="Entrez la description du champ" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="dir_champs_insp" class="form-label">Direction</label>
                            <select class="form-control" id="dir_champs_insp" name="dir_champs_insp" required>
                                <option value="">Sélectionnez une direction</option>
                                <option value="DCQPC">DCQPC</option>
                                <option value="DCI">DCI</option>
                                <option value="DCRI">DCRI</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="icons_champs_insp" class="form-label">Icône (optionnelle)</label>
                            <input type="text" class="form-control" id="icons_champs_insp" name="icons_champs_insp" placeholder="Entrez le nom de l'icône (par exemple: fa-solid fa-clipboard)">
                        </div>

                        <button type="submit" class="btn btn-info me-2">Ajouter le Champ d'Inspection</button>
                        <a href="{{ route('champs.inspection.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
