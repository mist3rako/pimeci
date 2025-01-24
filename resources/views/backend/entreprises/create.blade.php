@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route('entreprises.index') }}">Liste des Entreprises</a></li>
            <li class="breadcrumb-item active" aria-current="page">Créer une Entreprise</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Créer une Entreprise</h6>
                    <form action="{{ route('entreprises.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Code Entreprise -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code_entreprise">Code Entreprise</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather="hash"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="code_entreprise" name="code_entreprise" placeholder="Entrez le code de l'entreprise" required>
                                    </div>
                                    @error('code_entreprise')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nom Entreprise -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom_entreprise">Nom de l'Entreprise</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather="briefcase"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" placeholder="Entrez le nom de l'entreprise" required>
                                    </div>
                                    @error('nom_entreprise')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Secteur d'Activité -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="secteur_activite">Secteur d'Activité</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather="activity"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" id="secteur_activite" name="secteur_activite" required>
                                            <option value="">Sélectionnez un secteur d'activité</option>
                                            @foreach($secteurs as $secteur)
                                                <option value="{{ $secteur->id }}">{{ $secteur->nom_secteur }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('secteur_activite')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Département -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="departement">Département</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather="map"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" id="departement" name="departement" required>
                                            <option value="">Sélectionnez un département</option>
                                            @foreach($adresses->unique('departement') as $adresse)
                                                <option value="{{ $adresse->departement }}">{{ $adresse->departement }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('departement')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Commune -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="commune">Commune</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather="map-pin"></i>
                                            </span>
                                        </div>
                                        <select class="form-control" id="commune" name="commune" required disabled>
                                            <option value="">Sélectionnez une commune</option>
                                        </select>
                                    </div>
                                    @error('commune')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Code Postal -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="code_postal">Code Postal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather="mail"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="Code postal" readonly>
                                    </div>
                                    @error('code_postal')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Rue (Adresse Manuelle) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rue">Rue (Adresse Manuelle)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i data-feather="map-pin"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="rue" name="rue" placeholder="Ex: 8, Rue Rigaud">
                                    </div>
                                    @error('rue')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                        <a href="{{ route('entreprises.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('departement').addEventListener('change', function() {
    var departement = this.value;
    fetch(`/communes/${departement}`)
        .then(response => response.json())
        .then(data => {
            var communeSelect = document.getElementById('commune');
            var codePostalInput = document.getElementById('code_postal');
            communeSelect.innerHTML = '<option value="">Sélectionnez une commune</option>';
            communeSelect.disabled = false;
            codePostalInput.value = '';

            data.forEach(function(commune) {
                var option = document.createElement('option');
                option.value = commune.commune;
                option.text = commune.commune;
                communeSelect.appendChild(option);
            });

            communeSelect.addEventListener('change', function() {
                var selectedCommune = this.value;
                var selectedCodePostal = data.find(c => c.commune === selectedCommune).code_postal;
                codePostalInput.value = selectedCodePostal;
            });
        });
});
</script>

@endsection
