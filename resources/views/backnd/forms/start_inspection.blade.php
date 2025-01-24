@extends('inspecteur.inspecteur_dashboard')

@section('inspecteur')
<div class="container">
@livewire('formulaire-inspection' . $champId, ['inspectionId' => $inspectionId]) 
</div>
@endsection 