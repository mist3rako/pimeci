@extends('admin.admin_dashboard')

@section('admin')
<div class="page-content">

    <!-- Breadcrumb -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route('planifications.index') }}">Gestion des Planifications</a></li>
            <li class="breadcrumb-item active" aria-current="page">Détails de la Planification</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Détails de la Planification</h4>

                    <!-- Informations de la planification -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div><strong>ID:</strong> {{ $planification->id }}</div>
                            <div><strong>No Planification:</strong> {{ $planification->plan_mission_code }}</div>
                            <div><strong>Statut:</strong>
                                <span class="badge text-white" style="
                                    @if($planification->plan_progress_statut == 'Planifié') background-color: #007bff;
                                    @elseif($planification->plan_progress_statut == 'En cours') background-color: #ffc107;
                                    @elseif($planification->plan_progress_statut == 'Complète') background-color: #28a745;
                                    @else background-color: #dc3545;
                                    @endif">
                                    {{ $planification->plan_progress_statut }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div><strong>Type d'Intervention:</strong> {{ $planification->typeIntervention->nom_type_intervention }}</div>
                            <div><strong>Champ d'Inspection:</strong> {{ $planification->champsInspection->nom_champs }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div><strong>Nom Entreprise:</strong> {{ $planification->entreprise->nom_entreprise }}</div>
                            <div><strong>Lieu d'inspection:</strong> {{ $planification->entreprise->rue }}, {{ $planification->entreprise->adresse->commune }}, {{ $planification->entreprise->adresse->departement }}</div>
                        </div>
                    </div>

                    <!-- Inspecteurs impliqués -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5 class="mb-3"><i class="fas fa-users"></i> Inspecteurs</h5>
                            <div class="d-flex flex-wrap">
                                <div class="p-2">
                                    <strong>Chef de Brigade:</strong> {{ $planification->chefDeBrigade->nom }} {{ $planification->chefDeBrigade->prenom }}
                                </div>
                                @if($planification->id_users2)
                                    <div class="p-2">
                                        <strong>2e Inspecteur:</strong> {{ $planification->idUsers2->nom }} {{ $planification->idUsers2->prenom }}
                                    </div>
                                @endif
                                @if($planification->id_users3)
                                    <div class="p-2">
                                        <strong>3e Inspecteur:</strong> {{ $planification->idUsers3->nom }} {{ $planification->idUsers3->prenom }}
                                    </div>
                                @endif
                                @if($planification->id_users4)
                                    <div class="p-2">
                                        <strong>4e Inspecteur:</strong> {{ $planification->idUsers4->nom }} {{ $planification->idUsers4->prenom }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Dates de planification et d'inspection -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div><strong>Date de Planification:</strong> {{ \Carbon\Carbon::parse($planification->created_at)->translatedFormat('d F Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div><strong>Date et Heure de l'Inspection:</strong> {{ \Carbon\Carbon::parse($planification->date_inspection)->translatedFormat('d F Y h:i A') }}</div>
                        </div>
                    </div>

                    <!-- Retour à la liste -->
                    <div class="mt-4">
                        <a href="{{ route('planifications.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
