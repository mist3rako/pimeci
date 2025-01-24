@extends('inspecteur.inspecteur_dashboard')

@section('inspecteur')
<div class="container">
    <h1>Détails du Formulaire</h1>
    <p>Nom Champ: {{ $form->nom_champs }}</p>
    <p>Description: {{ $form->champs_descr }}</p>
    <!-- Ajoutez d'autres détails selon vos besoins --> 
</div>
@endsection
