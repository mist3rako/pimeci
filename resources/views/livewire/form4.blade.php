<div>
    <h2>Formulaire d'Inspection en 3 Étapes</h2>

    @if ($currentStep === 1)
        <div>
            <h3>Étape 1: Informations Générales</h3>
            <div class="mb-3">
                <label for="field1" class="form-label">Champ 1</label>
                <input type="text" class="form-control" id="field1" wire:model="data.field1" required>
            </div>
            <button wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    @elseif ($currentStep === 2)
        <div>
            <h3>Étape 2: Détails Complémentaires</h3>
            <div class="mb-3">
                <label for="field2" class="form-label">Champ 2</label>
                <input type="text" class="form-control" id="field2" wire:model="data.field2" required>
            </div>
            <button wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    @elseif ($currentStep === 3)
        <div>
            <h3>Étape 3: Confirmation</h3>
            <div>
                <h4>Résumé des informations :</h4>
                <p>Champ 1: {{ $data['field1'] }}</p>
                <p>Champ 2: {{ $data['field2'] }}</p>
                <!-- Affichez d'autres champs ici -->
            </div>
            <button wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button wire:click="submit" class="btn btn-success">Soumettre</button>
        </div>
    @endif
</div>
