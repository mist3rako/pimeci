@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <!-- Breadcrumb -->
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route('planifications.index') }}">Gestion des Planifications</a></li>
            <li class="breadcrumb-item active" aria-current="page">Créer une Planification</li>
        </ol>
    </nav>

    <!-- Utilisation du composant Livewire -->
    <livewire:planification-create />

</div>

@endsection
