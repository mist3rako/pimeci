@extends('inspecteur.inspecteur_dashboard')

@section('inspecteur')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Confirmer la Suppression</h4>
                </div>
                <div class="card-body">
                    <p>Êtes-vous sûr de vouloir supprimer l'entreprise <strong>{{ $entreprise->nom_entreprise }}</strong> ? Cette action est irréversible.</p>
                    <form action="{{ route('entreprises.destroy', $entreprise->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('entreprises.index') }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
