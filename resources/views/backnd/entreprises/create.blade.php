@extends('inspecteur.inspecteur_dashboard')

@section('inspecteur')

<div class="container">
    <!-- Breadcrumb Navigation -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inspecteur.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route('inspecteur.inspections.entreprises') }}">Liste des Entreprises</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter une Entreprise</li>
        </ol>
    </nav>

    <!-- Card for Ajouter une Entreprise -->
    <div class="card mb-5 mb-xl-8">
        <!-- Card Header -->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Ajouter une Entreprise</span>
                <span class="text-muted mt-1 fw-bold fs-7">Remplissez les informations de l'entreprise</span>
            </h3>
        </div>
        <!-- End Card Header -->

        <!-- Card Body -->
        <div class="card-body py-3">
            <!-- Affichage des messages de succès -->
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Formulaire de Création -->
            <form action="{{ route('entreprises.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <!-- Code Entreprise -->
                    <div class="col-md-6">
                        <label for="code_entreprise" class="form-label">Code Entreprise</label>
                        <input type="text" name="code_entreprise" id="code_entreprise" class="form-control @error('code_entreprise') is-invalid @enderror" value="{{ old('code_entreprise') }}" required>
                        @error('code_entreprise')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Nom Entreprise -->
                    <div class="col-md-6">
                        <label for="nom_entreprise" class="form-label">Nom de l'Entreprise</label>
                        <input type="text" name="nom_entreprise" id="nom_entreprise" class="form-control @error('nom_entreprise') is-invalid @enderror" value="{{ old('nom_entreprise') }}" required>
                        @error('nom_entreprise')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Secteur d'Activité -->
                    <div class="col-md-6">
                        <label for="secteur_activite" class="form-label">Secteur d'Activité</label>
                        <select name="secteur_activite" id="secteur_activite" class="form-select @error('secteur_activite') is-invalid @enderror" required>
                            <option value="">Sélectionnez un Secteur</option>
                            @foreach($secteurs as $secteur)
                                <option value="{{ $secteur->id }}" {{ old('secteur_activite') == $secteur->id ? 'selected' : '' }}>
                                    {{ $secteur->nom_secteur }}
                                </option>
                            @endforeach
                        </select>
                        @error('secteur_activite')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Département -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="departement" class="form-label">Département</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i data-feather="map"></i>
                                    </span>
                                </div>
                                <select name="departement" id="departement" class="form-control @error('departement') is-invalid @enderror" required>
                                    <option value="">Sélectionnez un département</option>
                                    @foreach($adresses->unique('departement') as $adresse)
                                        <option value="{{ $adresse->departement }}" {{ old('departement') == $adresse->departement ? 'selected' : '' }}>
                                            {{ $adresse->departement }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('departement')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Commune -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="commune" class="form-label">Commune</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i data-feather="map-pin"></i>
                                    </span>
                                </div>
                                <select name="commune" id="commune" class="form-control @error('commune') is-invalid @enderror" required>
                                    <option value="">Sélectionnez une commune</option>
                                    @if(old('departement'))
                                        @foreach($adresses->where('departement', old('departement'))->unique('commune') as $adresse)
                                            <option value="{{ $adresse->commune }}" {{ old('commune') == $adresse->commune ? 'selected' : '' }}>
                                                {{ $adresse->commune }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @error('commune')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Rue -->
                    <div class="col-md-6">
                        <label for="rue" class="form-label">Rue</label>
                        <input type="text" name="rue" id="rue" class="form-control @error('rue') is-invalid @enderror" value="{{ old('rue') }}">
                        @error('rue')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Boutons de Soumission -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('entreprises.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
        <!-- End Card Body -->
    </div>
    <!-- End Card -->
</div>

<!-- Script pour la sélection dynamique des communes -->


@endsection
