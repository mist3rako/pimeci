@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <!-- Breadcrumb -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route('entreprises.index') }}">Liste des Entreprises</a></li>
            <li class="breadcrumb-item active" aria-current="page">Confirmer la Suppression</li>
        </ol>
    </nav>

    <!-- Page Content -->
    <div class="row">
        <div class="col-md-8 offset-md-2 grid-margin stretch-card">
            <div class="card">
                <!-- Card Body -->
                <div class="card-body text-center">
                    <h4 class="card-title">Confirmer la Suppression</h4>
                    <p>Êtes-vous sûr de vouloir supprimer l'entreprise suivante ?</p>
                    <h5>{{ $entreprise->nom_entreprise }}</h5>
                    <p><strong>Code :</strong> {{ $entreprise->code_entreprise }}</p>
                    <!-- Formulaire de suppression -->
                    <form action="{{ route('entreprises.destroy', $entreprise->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                        <a href="{{ route('entreprises.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div> <!-- End Card Body -->
            </div> <!-- End Card -->
        </div> <!-- End Col -->
    </div> <!-- End Row -->

</div> <!-- End Page Content -->

@endsection
