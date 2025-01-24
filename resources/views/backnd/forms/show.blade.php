@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Démarrer l'Inspection</h1>
    <p>Inspection Code: {{ $inspection->plan_mission_code }}</p>
    <!-- Autres détails pour démarrer l'inspection -->
    <form action="{{ route('form.store') }}" method="POST">
        @csrf
        <!-- Vos champs de formulaire ici -->
        <button type="submit">Soumettre</button>
    </form>
</div>
@endsection
