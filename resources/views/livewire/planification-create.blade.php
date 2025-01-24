<div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Créer une Nouvelle Planification</h5>

            <!-- Étape 1 : Informations Générales -->
            @if ($step == 1)
                <div class="step-1">
                    <h6>Étape 1: Informations Générales</h6>
                    <div class="form-group">
    <label for="id_type_intervention"><i class="fas fa-tasks"></i> Type d'Intervention</label>
    <select wire:model="id_type_intervention" id="id_type_intervention" class="form-control">
        <option value="">-- Sélectionnez --</option>
        @foreach($typeInterventions as $type)
            <option value="{{ $type->id }}">{{ $type->nom_type_intervention }}</option>
        @endforeach
    </select>
    @error('id_type_intervention') <span class="text-danger">{{ $message }}</span> @enderror
</div>


                    <div class="form-group">
                        <label for="id_entreprises"><i class="fas fa-building"></i> Nom Entreprise</label>
                        <select wire:model="id_entreprises" id="id_entreprises" class="form-control">
                            <option value="">-- Sélectionnez --</option>
                            @foreach($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}">{{ $entreprise->nom_entreprise }}</option> 
                            @endforeach
                        </select>
                        @error('id_entreprises') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
    <label for="id_champs_inspection"><i class="fas fa-list"></i> Champs d'Inspection</label>
    <select wire:model="id_champs_inspection" id="id_champs_inspection" class="form-control">
        <option value="">-- Sélectionnez --</option>
        @foreach($champsInspections as $champ)
            <option value="{{ $champ->id }}">{{ $champ->nom_champs }}</option>
        @endforeach
    </select>
    @error('id_champs_inspection') <span class="text-danger">{{ $message }}</span> @enderror
</div>


                    <div class="form-group">
                        <label for="id_users"><i class="fas fa-user-tie"></i> Chef de Brigade</label>
                        <select wire:model="id_users" id="id_users" class="form-control">
                            <option value="">-- Sélectionnez --</option>
                            @foreach($inspecteurs as $inspecteur)
                                <option value="{{ $inspecteur->id }}">
                                    {{ $inspecteur->nom }} {{ $inspecteur->prenom }} - {{ strtoupper(str_replace('_', ' ', $inspecteur->role_as)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_users') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button wire:click="nextStep" class="btn btn-primary">Suivant</button>
                </div>
            @endif

            <!-- Étape 2 : Inspecteurs additionnels (facultatif) -->
            @if ($step == 2)
                <div class="step-2">
                    <h6>Étape 2: Inspecteurs Additionnels (Facultatif)</h6>
                    <div class="form-group">
                        <label for="inspecteur_2"><i class="fas fa-user"></i> 2ème Inspecteur</label>
                        <select wire:model="id_users2" id="inspecteur_2" class="form-control">
                            <option value="">-- Sélectionnez --</option>
                            @foreach($inspecteurs->where('id', '!=', $id_users) as $inspecteur)
                                <option value="{{ $inspecteur->id }}">
                                    {{ $inspecteur->nom }} {{ $inspecteur->prenom }} - {{ strtoupper(str_replace('_', ' ', $inspecteur->role_as)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inspecteur_3"><i class="fas fa-user"></i> 3ème Inspecteur</label>
                        <select wire:model="id_users3" id="inspecteur_3" class="form-control">
                            <option value="">-- Sélectionnez --</option>
                            @foreach($inspecteurs->where('id', '!=', $id_users)->where('id', '!=', $id_users2) as $inspecteur)
                                <option value="{{ $inspecteur->id }}">
                                    {{ $inspecteur->nom }} {{ $inspecteur->prenom }} - {{ strtoupper(str_replace('_', ' ', $inspecteur->role_as)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inspecteur_4"><i class="fas fa-user"></i> 4ème Inspecteur</label>
                        <select wire:model="id_users4" id="inspecteur_4" class="form-control">
                            <option value="">-- Sélectionnez --</option>
                            @foreach($inspecteurs->where('id', '!=', $id_users)->where('id', '!=', $id_users2)->where('id', '!=', $id_users3) as $inspecteur)
                                <option value="{{ $inspecteur->id }}">
                                    {{ $inspecteur->nom }} {{ $inspecteur->prenom }} - {{ strtoupper(str_replace('_', ' ', $inspecteur->role_as)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button wire:click="previousStep" class="btn btn-secondary">Retour</button>
                    <button wire:click="nextStep" class="btn btn-primary">Suivant</button>
                </div>
            @endif

 <!-- Étape 3 : Date de planification et lieu d'inspection -->
@if ($step == 3)
    <div class="step-3">
        <h6>Étape 3: Date et Heure de l'Inspection</h6>
        <div class="form-group">
            <label for="date_inspection"><i class="fas fa-calendar-alt"></i> Date et Heure d'Inspection</label>
            <input type="datetime-local" wire:model="date_inspection" id="date_inspection" class="form-control">
            @error('date_inspection') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="lieu_inspection"><i class="fas fa-map-marker-alt"></i> Lieu d'Inspection</label>
            <input type="text" id="lieu_inspection" class="form-control" value="{{ $lieu_inspection }}" disabled>
        </div>

        <button wire:click="previousStep" class="btn btn-secondary">Retour</button>
        <button wire:click="nextStep" class="btn btn-primary">Suivant</button>
    </div>
@endif

            <!-- Étape 4 : Aperçu des informations -->
<!-- Étape 4 : Aperçu des informations -->
@if ($step == 4)
    <div class="step-4">
        <h6>Étape 4: Aperçu des Informations</h6>
        <h4><i class="fas fa-eye"></i> Aperçu des informations</h4>
        <div id="summary" class="row">
            <div class="col-md-6">
                <p><strong><i class="fas fa-list-alt"></i> No Planification:</strong> {{ $plan_mission_code }}</p>
                <p><strong><i class="fas fa-building"></i> Nom Entreprise:</strong> {{ $entreprises->where('id', $id_entreprises)->first()->nom_entreprise ?? '' }}</p>
                <p><strong><i class="fas fa-tasks"></i> Type d'Intervention:</strong> {{ $typeInterventions->where('id', $id_type_intervention)->first()->nom_type_intervention ?? '' }}</p>
                <p><strong><i class="fas fa-list"></i> Champ d'Inspection:</strong> {{ $champsInspections->where('id', $id_champs_inspection)->first()->nom_champs ?? '' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong><i class="fas fa-user-tie"></i> Chef de Brigade:</strong> {{ $inspecteurs->where('id', $id_users)->first()->nom ?? '' }} {{ $inspecteurs->where('id', $id_users)->first()->prenom ?? '' }}</p>
                @if($id_users2)
                    <p><strong><i class="fas fa-user"></i> 2e Inspecteur:</strong> {{ $inspecteurs->where('id', $id_users2)->first()->nom ?? '' }} {{ $inspecteurs->where('id', $id_users2)->first()->prenom ?? '' }}</p>
                @endif
                @if($id_users3)
                    <p><strong><i class="fas fa-user"></i> 3e Inspecteur:</strong> {{ $inspecteurs->where('id', $id_users3)->first()->nom ?? '' }} {{ $inspecteurs->where('id', $id_users3)->first()->prenom ?? '' }}</p>
                @endif
                @if($id_users4)
                    <p><strong><i class="fas fa-user"></i> 4e Inspecteur:</strong> {{ $inspecteurs->where('id', $id_users4)->first()->nom ?? '' }} {{ $inspecteurs->where('id', $id_users4)->first()->prenom ?? '' }}</p>
                @endif
                <p><strong><i class="fas fa-calendar-alt"></i> Date et Heure de l'Inspection:</strong> {{ $this->getFormattedDate($date_inspection) }}</p>
                <p><strong><i class="fas fa-user-cog"></i> Planifié Par:</strong> {{ $admin_name }}</p>
            </div>
        </div>

        <button wire:click="previousStep" class="btn btn-secondary">Retour</button>
        <button wire:click="submit" class="btn btn-success">Planifier</button>
    </div>
@endif

        </div>
    </div>
</div>
