<div>
    @if ($currentStep === 1)
        <div>
            <h3>2 Étape 1: Informations Générales</h3>

            <!-- Afficher les détails de l'inspection -->
            <p>Code Inspection: {{ $inspection->plan_mission_code }}</p>
            <p>Statut: {{ $inspection->plan_progress_statut }}</p>
            <p>Chef de Brigade: {{ optional($inspection->chefDeBrigade)->nom }} {{ optional($inspection->chefDeBrigade)->prenom }}</p>
            <p>Inspecteurs Assignés:</p>
            <ul>
                @if($inspection->idUsers2 || $inspection->idUsers3 || $inspection->idUsers4)
                    @if($inspection->idUsers2)
                        <li>{{ optional($inspection->idUsers2)->nom }} {{ optional($inspection->idUsers2)->prenom }}</li>
                    @endif
                    @if($inspection->idUsers3)
                        <li>{{ optional($inspection->idUsers3)->nom }} {{ optional($inspection->idUsers3)->prenom }}</li>
                    @endif
                    @if($inspection->idUsers4)
                        <li>{{ optional($inspection->idUsers4)->nom }} {{ optional($inspection->idUsers4)->prenom }}</li>
                    @endif
                @else
                    <li>Aucun autre inspecteur assigné</li>
                @endif
            </ul>
            <p>Nom Entreprise: {{ optional($inspection->entreprise)->nom_entreprise ?? 'N/A' }}</p>
            <p>Lieu d'Inspection: {{ optional($inspection->entreprise)->rue ?? 'Adresse inconnue' }}, {{ optional($inspection->entreprise)->adresse->commune ?? 'Inconnue' }}, {{ optional($inspection->entreprise)->adresse->departement ?? 'Inconnu' }}</p>
            <p>Type d'Intervention: {{ optional($inspection->typeIntervention)->nom_type_intervention ?? 'N/A' }}</p>
            <p>Date de Planification: {{ $inspection->date_inspection ? $inspection->date_inspection->format('d/m/Y') : 'N/A' }}</p>
            <p>Champs d'Inspection: {{ optional($inspection->champsInspection)->nom_champs ?? 'N/A' }}</p>
            <p>Date et Heure de l'Inspection: {{ $inspection->date_inspection ? $inspection->date_inspection->format('d/m/Y h:i A') : 'N/A' }}</p>

            <!-- Vos champs pour l'étape 1 -->
            <div class="mb-3">
                <label for="field1" class="form-label">Champ 1</label>
                <input type="text" class="form-control" id="field1" wire:model="data.field1" required>
            </div>
            <button wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    @elseif ($currentStep === 2)
        <!-- Étape 2 -->
    @elseif ($currentStep === 3)
        <!-- Étape 3 -->
    @endif
</div>
