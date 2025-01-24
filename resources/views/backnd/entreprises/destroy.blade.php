@extends('inspecteur.inspecteur_dashboard')
@section('inspecteur')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inspecteur.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route('entreprises.index') }}">Liste des Entreprises</a></li>
            <li class="breadcrumb-item active" aria-current="page">Supprimer l'Entreprise</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Supprimer l'Entreprise</h6>
                    <p>Êtes-vous sûr de vouloir supprimer cette entreprise ? Cette action est irréversible.</p>
                    
                    <!-- Informations de l'entreprise -->
                    <div class="mb-4">
                        <strong>Code Entreprise :</strong> {{ $entreprise->code_entreprise }}<br>
                        <strong>Nom :</strong> {{ $entreprise->nom_entreprise }}<br>
                        <strong>Secteur d'Activité :</strong> {{ $entreprise->secteurActivite ? $entreprise->secteurActivite->nom_secteur : 'N/A' }}<br>
                        <strong>Adresse :</strong> {{ $entreprise->adresse ? $entreprise->adresse->departement . ', ' . $entreprise->adresse->commune : 'N/A' }}<br>
                        <strong>Rue :</strong> {{ $entreprise->rue }}<br>
                    </div>

                    <!-- Formulaire de confirmation de suppression -->
                    <form action="{{ route('entreprises.destroy', $entreprise->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">Confirmer la Suppression</button>
                        <a href="{{ route('entreprises.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection