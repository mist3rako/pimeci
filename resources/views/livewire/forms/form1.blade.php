@if ($currentStep === 1)
    <div>
        <h3>Formulaire 1 - Étape 1</h3>
        <!-- Vos champs spécifiques pour le formulaire 1, étape 1 -->
        <div class="mb-3">
            <label for="field1" class="form-label">Champ spécifique 1</label>
            <input type="text" class="form-control" id="field1" wire:model="data.field1" required>
        </div>
        <button wire:click="nextStep" class="btn btn-primary">Suivant</button>
    </div>
@endif
<!-- Continuez avec les autres étapes pour ce formulaire -->
