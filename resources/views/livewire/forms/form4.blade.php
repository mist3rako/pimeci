<style>
    .progress-container {
        position: relative;
    }

    .progress {
        height: 20px;
    }

    .progress-indicator .step1,
    .progress-indicator .step2,
    .progress-indicator .step3,
    .progress-indicator .step4,
    .progress-indicator .step5,
    .progress-indicator .step6,
    .progress-indicator .step7,
    .progress-indicator .step8,
    .progress-indicator .step9, 
    .progress-indicator .step10 {
        width: 10%;
        text-align: center;
        position: relative;
    }

    .progress-indicator .step1 span,
    .progress-indicator .step2 span,
    .progress-indicator .step3 span,
    .progress-indicator .step4 span,
    .progress-indicator .step5 span,
    .progress-indicator .step6 span,
    .progress-indicator .step7 span,
    .progress-indicator .step8 span,
    .progress-indicator .step9 span,
    .progress-indicator .step10 span {
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        background-color: #ccc;
        border-radius: 50%;
        color: #fff;
    }

    .progress-indicator .active span {
        background-color: #28a745;
    }
</style>

<div>
    <!-- Barre de Progression -->
    <div class="progress-container mb-4">
        <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: {{ ($currentStep / 10) * 100 }}%;" aria-valuenow="{{ $currentStep }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="progress-indicator d-flex justify-content-between mt-2">
        @for ($i = 1; $i <= 10; $i++)
    <div class="step{{ $i }} {{ $currentStep >= $i ? 'active' : '' }}">
        <span>{{ $i }}</span>
    </div>
@endfor

        </div>
    </div>

    <form wire:submit.prevent="submit">
        @csrf

        <!-- Étape 1: Identification de l’entreprise -->
        @if ($currentStep === 1)
            <div>
                <h3>Étape 1: Identification de l’entreprise</h3>
                <div class="row">
                    <!-- Colonne de gauche -->
                    <div class="col-md-6">
                        <!-- No d’intervention -->
                        <div class="form-group">
                            <label>1. No d’intervention:</label>
                            <input type="text" class="form-control" value="{{ $inspection->plan_mission_code ?? 'N/A' }}" readonly>
                        </div>

                        <!-- Type d’intervention -->
                        <div class="form-group">
                            <label>2. Type d’intervention:</label>
                            <input type="text" class="form-control" value="{{ optional($inspection->typeIntervention)->nom_type_intervention ?? 'N/A' }}" readonly>
                        </div>

                        <!-- Type ou catégorie d’entreprise -->
                        <div class="form-group">
                            <label for="type_entreprise">3. Type ou catégorie d’entreprise</label>
                            <input type="text" class="form-control" id="type_entreprise" wire:model.defer="data.type_entreprise" required>
                            @error('data.type_entreprise') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Secteur d'activité -->
                        <div class="form-group">
                            <label>4. Secteur d'activité:</label>
                            <input type="text" class="form-control" value="{{ optional($inspection->champsInspection)->nom_champs ?? 'N/A' }}" readonly>
                        </div>

                        <!-- Nom de l’entreprise -->
                        <div class="form-group">
                            <label>5. Nom de l’entreprise:</label>
                            <input type="text" class="form-control" value="{{ optional($inspection->entreprise)->nom_entreprise ?? 'N/A' }}" readonly>
                        </div>

                        <!-- Propriétaire ou responsable -->
                        <div class="form-group">
                            <label for="proprietaire">6. Propriétaire ou responsable</label>
                            <input type="text" class="form-control" id="proprietaire" wire:model.defer="data.proprietaire" required>
                            @error('data.proprietaire') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Téléphone -->
                        <div class="form-group">
                            <label for="telephone">7. Téléphone</label>
                            <input type="text" class="form-control" id="telephone" wire:model.defer="data.telephone" maxlength="14" required placeholder="(509)XXXX-XXXX">
                            @error('data.telephone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Colonne de droite -->
                    <div class="col-md-6">
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">8. Email</label>
                            <input type="email" class="form-control" id="email" wire:model.defer="data.email" required>
                            @error('data.email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- L’entreprise est régulièrement enregistrée au MCI -->
                        <div class="form-group">
                            <label for="entreprise_enregistree">9. L’entreprise est régulièrement enregistrée au MCI</label>
                            <select class="form-control" id="entreprise_enregistree" wire:model="data.entreprise_enregistree" required>
                                <option value="">Sélectionner</option>
                                <option value="Non">Non</option>
                                <option value="Oui">Oui</option>
                            </select>
                            @error('data.entreprise_enregistree') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Numéro Identification Professionnelle (Conditionnel) -->
                        @if ($data['entreprise_enregistree'] === 'Oui')
                            <div class="form-group">
                                <label for="numero_identification">10. Numéro d’Identification Professionnelle</label>
                                <input type="text" class="form-control" id="numero_identification" wire:model.defer="data.numero_identification" pattern="[A-Z]-\d{5}" placeholder="X-XXXXX" maxlength="7">
                                @error('data.numero_identification') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        <!-- Autres autorisations de fonctionnement -->
                        <div class="form-group">
                            <label for="autres_autorisations">11. L’entreprise a d’autres autorisations de fonctionnement</label>
                            <select class="form-control" id="autres_autorisations" wire:model.defer="data.autres_autorisations" required>
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.autres_autorisations') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Numéro de patente -->
                        <div class="form-group">
                            <label for="numero_patente">12. Numéro de patente</label>
                            <input type="text" class="form-control" id="numero_patente" wire:model.defer="data.numero_patente" maxlength="13" placeholder="XXX-XXX-XXX-X" pattern="^\d{3}-\d{3}-\d{3}-\d$">
                            @error('data.numero_patente') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Adresse de l’entreprise -->
                        <div class="form-group">
                            <label>13. Adresse de l’entreprise:</label>
                            <input type="text" class="form-control" value="{{ optional($inspection->entreprise)->rue ?? 'Adresse inconnue' }}, {{ optional($inspection->entreprise->adresse)->commune ?? 'Inconnue' }}, {{ optional($inspection->entreprise->adresse)->departement ?? 'Inconnu' }}" readonly>
                        </div>

                        <!-- Coordonnées GPS -->
                        <div class="form-group">
                            <label for="coordonnees_gps">14. Coordonnées GPS</label>
                            <input type="text" class="form-control" id="coordonnees_gps" wire:model.defer="data.coordonnees_gps" readonly>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="gpsCheckbox" wire:click="getGpsCoordinates">
                                <label class="form-check-label" for="gpsCheckbox">
                                    Obtenir les coordonnées GPS sur le lieu
                                </label>
                            </div>
                            @error('data.coordonnees_gps') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Bouton Suivant -->
                <div class="d-flex justify-content-end">
                    <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
                </div>
            </div>
        @endif

        <!-- Étape 2: Production et Intrants -->
        @if ($currentStep === 2)
            <div>
                <h3>Étape 2: Production et Intrants</h3>
                <div class="row">
                    <!-- Colonne de gauche -->
                    <div class="col-md-6">
                        <h4>Informations sur la Production</h4>
                        <!-- Tableau Dynamique des Produits -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Fréquence de production</th>
                                    <th>Production journalière</th>
                                    <th>Vente journalière</th>
                                    <th>Mode de vente</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="productionTableBody">
                                @foreach ($data['produits'] as $index => $produit)
                                    <tr>
                                        <td><input type="text" class="form-control" wire:model.defer="data.produits.{{ $index }}.nom" placeholder="Produit {{ $index + 1 }}"></td>
                                        <td><input type="text" class="form-control" wire:model.defer="data.produits.{{ $index }}.frequence" placeholder="Fréquence de production"></td>
                                        <td><input type="text" class="form-control" wire:model.defer="data.produits.{{ $index }}.production_journaliere" placeholder="Chiffre"></td>
                                        <td><input type="text" class="form-control" wire:model.defer="data.produits.{{ $index }}.vente_journaliere" placeholder="Chiffre"></td>
                                        <td><input type="text" class="form-control" wire:model.defer="data.produits.{{ $index }}.mode_vente" placeholder="En vrac ou emballé"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" wire:click="removeProduct({{ $index }})">Supprimer</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @error('data.produits.*.nom') <span class="text-danger">Nom du produit est requis.</span> @enderror
                        <button type="button" class="btn btn-outline-primary mb-2" wire:click="addProduct()">Ajouter un produit</button>

                        <h4>Étapes de Production et Risques Associés</h4>
                        <!-- Tableau Dynamique des Étapes et Risques -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Étape de la production</th>
                                    <th>Risques associés</th>
                                    <th>Maîtrise des risques</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="risquesTableBody">
                                @foreach ($data['etapes'] as $index => $etape)
                                    <tr>
                                        <td><input type="text" class="form-control" wire:model.defer="data.etapes.{{ $index }}.etape" placeholder="Étape {{ $index + 1 }}"></td>
                                        <td><input type="text" class="form-control" wire:model.defer="data.etapes.{{ $index }}.risque_associe" placeholder="Risques associés"></td>
                                        <td>
                                            <select class="form-control" wire:model.defer="data.etapes.{{ $index }}.maitrise_risques">
                                                <option value="">Sélectionner</option>
                                                <option value="Oui">Oui</option>
                                                <option value="Non">Non</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" wire:click="removeEtape({{ $index }})">Supprimer</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @error('data.etapes.*.etape') <span class="text-danger">Étape de production est requise.</span> @enderror
                        <button type="button" class="btn btn-outline-primary mb-2" wire:click="addEtape()">Ajouter une étape</button>
                    </div>

                    <!-- Colonne de droite -->
                    <div class="col-md-6">
                        <h4>Autres Informations sur les Intrants</h4>

                        <!-- Intrants entrant dans la production -->
                        <div class="form-group">
                            <label for="intrants_matiere">15. Intrants entrant dans la production</label>
                            <input type="text" class="form-control" id="intrants_matiere" wire:model.defer="data.intrants_matiere" placeholder="Matières premières">
                            @error('data.intrants_matiere') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Les intrants sont bien étiquetés -->
                        <div class="form-group">
                            <label for="etiquetage_intrants">16. Les intrants sont bien étiquetés</label>
                            <select class="form-control" id="etiquetage_intrants" wire:model.defer="data.etiquetage_intrants">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                                <option value="NA">NA</option>
                            </select>
                            @error('data.etiquetage_intrants') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Intrants conformes -->
                        <div class="form-group">
                            <label for="conformite_intrants">17. Intrants conformes</label>
                            <select class="form-control" id="conformite_intrants" wire:model.defer="data.conformite_intrants">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.conformite_intrants') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Intrants retraçables -->
                        <div class="form-group">
                            <label for="tracabilite_intrants">18. Intrants retraçables</label>
                            <select class="form-control" id="tracabilite_intrants" wire:model.defer="data.tracabilite_intrants">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.tracabilite_intrants') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Exigences relatives aux intrants -->
                        <div class="form-group">
                            <label for="exigences_intrants">19. Exigences relatives aux intrants</label>
                            <input type="text" class="form-control" id="exigences_intrants" wire:model.defer="data.exigences_intrants" placeholder="à préciser par les responsables">
                            @error('data.exigences_intrants') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Existence de dispositifs de contrôle à la réception -->
                        <div class="form-group">
                            <label for="controle_reception">20. Existence de dispositifs de contrôle à la réception</label>
                            <select class="form-control" id="controle_reception" wire:model.defer="data.controle_reception">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.controle_reception') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Existence d’un registre de contrôle ou des certificats d’analyse -->
                        <div class="form-group">
                            <label for="registre_controle">21. Existence d’un registre de contrôle ou des certificats d’analyse</label>
                            <select class="form-control" id="registre_controle" wire:model.defer="data.registre_controle">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.registre_controle') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Les intrants subissent des traitements -->
                        <div class="form-group">
                            <label for="traitement_intrants">22. Les intrants subissent des traitements</label>
                            <select class="form-control" id="traitement_intrants" wire:model.defer="data.traitement_intrants">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.traitement_intrants') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Retour ou destruction d’intrants non conformes -->
                        <div class="form-group">
                            <label for="retour_destruction_intrants">23. Retour ou destruction d’intrants non conformes</label>
                            <select class="form-control" id="retour_destruction_intrants" wire:model.defer="data.retour_destruction_intrants">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                                <option value="NA">NA</option>
                            </select>
                            @error('data.retour_destruction_intrants') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Boutons Précédent et Suivant -->
                <div class="d-flex justify-content-between">
                    <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
                    <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
                </div>
            </div>
        @endif

        <!-- Étape 3: Contrôle de la Qualité -->
        @if ($currentStep === 3)
            <div>
                <h3>Étape 3: Contrôle de la Qualité</h3>
                <div class="row">
                    <!-- Colonne de gauche -->
                    <div class="col-md-6">
                        <h4>Tests sur place et prélèvement d’échantillons</h4>

                        <!-- Système de qualité -->
                        <div class="form-group">
                            <label for="systeme_qualite">24. Système de qualité</label>
                            <select class="form-control" id="systeme_qualite" wire:model.defer="data.systeme_qualite">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.systeme_qualite') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Plan de qualité -->
                        <div class="form-group">
                            <label for="plan_qualite">25. Plan de qualité</label>
                            <select class="form-control" id="plan_qualite" wire:model.defer="data.plan_qualite">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.plan_qualite') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Techniciens qualifiés en contrôle de qualité -->
                        <div class="form-group">
                            <label for="techniciens_qualifies">26. Techniciens qualifiés en contrôle de qualité</label>
                            <select class="form-control" id="techniciens_qualifies" wire:model.defer="data.techniciens_qualifies">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.techniciens_qualifies') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Certificats d’analyse à l’origine -->
                        <div class="form-group">
                            <label for="certificats_analyse_origine">27. Certificats d’analyse à l’origine</label>
                            <select class="form-control" id="certificats_analyse_origine" wire:model.defer="data.certificats_analyse_origine">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.certificats_analyse_origine') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Tests réalisés sur les marchandises à la réception -->
                        <div class="form-group">
                            <label for="tests_reception">28. Tests réalisés sur les marchandises à la réception</label>
                            <select class="form-control" id="tests_reception" wire:model.defer="data.tests_reception">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.tests_reception') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Types de tests -->
                        <div class="form-group">
                            <label for="types_tests">29. Types de tests</label>
                            <input type="text" class="form-control" id="types_tests" wire:model.defer="data.types_tests" placeholder="Organoleptique, physicochimique, microbiologique,…">
                            @error('data.types_tests') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Fréquence des tests -->
                        <div class="form-group">
                            <label for="frequence_tests">30. Fréquence des tests</label>
                            <input type="text" class="form-control" id="frequence_tests" wire:model.defer="data.frequence_tests" placeholder="Ex: Hebdomadaire">
                            @error('data.frequence_tests') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Laboratoire interne -->
                        <div class="form-group">
                            <label for="laboratoire_interne">31. Laboratoire interne</label>
                            <select class="form-control" id="laboratoire_interne" wire:model.defer="data.laboratoire_interne">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.laboratoire_interne') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Laboratoire externe -->
                        <div class="form-group">
                            <label for="laboratoire_externe">32. Laboratoire externe</label>
                            <select class="form-control" id="laboratoire_externe" wire:model.defer="data.laboratoire_externe">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.laboratoire_externe') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Registres ou certificats d’analyse disponibles -->
                        <div class="form-group">
                            <label for="registres_analyse">33. Registres ou certificats d’analyse disponibles</label>
                            <select class="form-control" id="registres_analyse" wire:model.defer="data.registres_analyse">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.registres_analyse') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Colonne de droite -->
                    <div class="col-md-6">
                        <!-- Tests d’échantillons sur place par l’inspecteur -->
                        <div class="form-group">
                            <label for="tests_echantillons">34. Tests d’échantillons sur place par l’inspecteur</label>
                            <input type="text" class="form-control" id="tests_echantillons" wire:model.defer="data.tests_echantillons" placeholder="Préciser le type : matière première, produits finis,…">
                            @error('data.tests_echantillons') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Date et heure du test -->
                        <div class="form-group">
                            <label for="date_heure_test">35. Date et heure du test</label>
                            <input type="datetime-local" class="form-control" id="date_heure_test" wire:model.defer="data.date_heure_test">
                            @error('data.date_heure_test') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Types de tests -->
                        <div class="form-group">
                            <label for="type_test">36. Types de tests</label>
                            <select class="form-control" id="type_test" wire:model.defer="data.type_test">
                                <option value="">Sélectionner</option>
                                <option value="Physico-chimique">Physico-chimique</option>
                                <option value="Bactériologique">Bactériologique</option>
                                <option value="Organoleptique">Organoleptique</option>
                            </select>
                            @error('data.type_test') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Objectifs des tests -->
                        <div class="form-group">
                            <label for="objectifs_tests">37. Objectifs des tests</label>
                            <input type="text" class="form-control" id="objectifs_tests" wire:model.defer="data.objectifs_tests" placeholder="Ex: Vérifier la conformité microbiologique">
                            @error('data.objectifs_tests') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Résultats obtenus -->
                        <div class="form-group">
                            <label for="resultats_obtenus">38. Résultats obtenus</label>
                            <input type="text" class="form-control" id="resultats_obtenus" wire:model.defer="data.resultats_obtenus" placeholder="Ex: Conforme/non conforme">
                            @error('data.resultats_obtenus') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Résultats conformes aux normes -->
                        <div class="form-group">
                            <label for="conformite_resultats">39. Les résultats sont-ils conformes aux normes ?</label>
                            <select class="form-control" id="conformite_resultats" wire:model.defer="data.conformite_resultats">
                                <option value="">Sélectionner</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>
                            @error('data.conformite_resultats') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Échantillons prélevés -->
                        <div class="form-group">
                            <label for="types_echantillons">40. Échantillons prélevés</label>
                            <input type="text" class="form-control" id="types_echantillons" wire:model.defer="data.types_echantillons" placeholder="Matière première, produits finis,…">
                            @error('data.types_echantillons') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Objectifs du prélèvement d’échantillons -->
                        <div class="form-group">
                            <label for="objectifs_prelevement">41. Objectifs du prélèvement d’échantillons</label>
                            <input type="text" class="form-control" id="objectifs_prelevement" wire:model.defer="data.objectifs_prelevement" placeholder="Pour quels types d’analyses">
                            @error('data.objectifs_prelevement') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Nombre d’échantillons prélevés -->
                        <div class="form-group">
                            <label for="nombre_echantillons">42. Nombre d’échantillons prélevés</label>
                            <input type="number" class="form-control" id="nombre_echantillons" wire:model.defer="data.nombre_echantillons" placeholder="Ex: 10">
                            @error('data.nombre_echantillons') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Codage des échantillons -->
                        <div class="form-group">
                            <label for="codage_echantillons">43. Codage des échantillons</label>
                            <input type="text" class="form-control" id="codage_echantillons" wire:model.defer="data.codage_echantillons" pattern="MCI-\d{6}ET" placeholder="MCI-140824ET" title="Format requis : MCI suivi d'un tiret, du jour, du mois et de l'année, puis 'ET'">
                            @error('data.codage_echantillons') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Boutons Précédent et Suivant -->
                <div class="d-flex justify-content-between">
                    <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
                    <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
                </div>
            </div>
        @endif

        @if ($currentStep === 4)
    <div>
        <h3>Étape 4: Emballage, Stockage, et Conditionnement</h3>
        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <!-- Types de conditionnement des produits -->
                <div class="form-group">
                    <label for="types_conditionnement">44. Types de conditionnement des produits</label>
                    <input type="text" class="form-control" id="types_conditionnement" wire:model.defer="data.types_conditionnement" placeholder="Ex: Bouteilles, sachets,…">
                    @error('data.types_conditionnement') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Produits finis étiquetés conformément aux normes -->
                <div class="form-group">
                    <label for="etiquetage_produits">45. Produits finis étiquetés conformément aux normes</label>
                    <select class="form-control" id="etiquetage_produits" wire:model.defer="data.etiquetage_produits">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                        <option value="NA">NA</option>
                    </select>
                    @error('data.etiquetage_produits') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Étiquettes présentent les informations nécessaires aux consommateurs -->
                <div class="form-group">
                    <label for="informations_etiquettes">46. Étiquettes présentent les informations nécessaires aux consommateurs</label>
                    <select class="form-control" id="informations_etiquettes" wire:model.defer="data.informations_etiquettes">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                        <option value="NA">NA</option>
                    </select>
                    @error('data.informations_etiquettes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- La quantité nette est mentionnée sur l’étiquette -->
                <div class="form-group">
                    <label for="quantite_nette">47. La quantité nette est mentionnée sur l’étiquette</label>
                    <select class="form-control" id="quantite_nette" wire:model.defer="data.quantite_nette">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                        <option value="NA">NA</option>
                    </select>
                    @error('data.quantite_nette') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Types d’emballage -->
                <div class="form-group">
                    <label for="types_emballage">48. Types d’emballage</label>
                    <input type="text" class="form-control" id="types_emballage" wire:model.defer="data.types_emballage" placeholder="Ex: Boîtes, pots,…">
                    @error('data.types_emballage') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Emballages certifiés alimentaires -->
                <div class="form-group">
                    <label for="emballages_certifies">49. Emballages certifiés alimentaires</label>
                    <select class="form-control" id="emballages_certifies" wire:model.defer="data.emballages_certifies">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.emballages_certifies') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Matériels de stockage et de conditionnement conformes -->
                <div class="form-group">
                    <label for="materiels_stockage">50. Matériels de stockage et de conditionnement conformes</label>
                    <select class="form-control" id="materiels_stockage" wire:model.defer="data.materiels_stockage">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.materiels_stockage') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Matériels de stockage certifiés alimentaires -->
                <div class="form-group">
                    <label for="materiels_certifies">51. Matériels de stockage certifiés alimentaires</label>
                    <select class="form-control" id="materiels_certifies" wire:model.defer="data.materiels_certifies">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.materiels_certifies') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Bonne pratique de stockage -->
                <div class="form-group">
                    <label for="bonne_pratique_stockage">52. Bonne pratique de stockage</label>
                    <select class="form-control" id="bonne_pratique_stockage" wire:model.defer="data.bonne_pratique_stockage">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.bonne_pratique_stockage') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Bonne gestion des stocks -->
                <div class="form-group">
                    <label for="gestion_stocks">53. Bonne gestion des stocks</label>
                    <select class="form-control" id="gestion_stocks" wire:model.defer="data.gestion_stocks">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.gestion_stocks') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Colonne de droite -->
            <div class="col-md-6">
                <!-- Plan de rappel en cas de produits non conformes mis sur le marché -->
                <div class="form-group">
                    <label for="plan_rappel">54. Plan de rappel en cas de produits non conformes mis sur le marché</label>
                    <select class="form-control" id="plan_rappel" wire:model.defer="data.plan_rappel">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.plan_rappel') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Expérience de rappel -->
                <div class="form-group">
                    <label for="experience_rappel">55. Expérience de rappel</label>
                    <select class="form-control" id="experience_rappel" wire:model.defer="data.experience_rappel">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.experience_rappel') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Ajoutez ici les questions 56 à 62 si nécessaire -->
                <!-- Exemple :
                <div class="form-group">
                    <label for="question56">56. [Question]</label>
                    <input type="text" class="form-control" id="question56" wire:model.defer="data.question56" placeholder="[Placeholder]">
                    @error('data.question56') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                -->
            </div>
        </div>

        <!-- Boutons Précédent et Suivant -->
        <div class="d-flex justify-content-between">
            <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    </div>
@endif

@if ($currentStep === 5)
    <div>
        <h3>Étape 5: Matériels/Équipements</h3>
        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <!-- Différents types d’équipement intervenant dans la production et leur rôle -->
                <div class="form-group">
                    <label for="types_equipements">56. Différents types d’équipement intervenant dans la production et leur rôle</label>
                    <input type="text" class="form-control" id="types_equipements" wire:model.defer="data.types_equipements" placeholder="Ex: Mélangeur, cuiseur,…">
                    @error('data.types_equipements') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Matériaux résistants à la corrosion -->
                <div class="form-group">
                    <label for="resistants_corrosion">57. Matériaux résistants à la corrosion</label>
                    <select class="form-control" id="resistants_corrosion" wire:model.defer="data.resistants_corrosion">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.resistants_corrosion') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Identifier des risques associés à chaque équipement -->
                <div class="form-group">
                    <label for="risques_associes">58. Identifier des risques associés à chaque équipement</label>
                    <select class="form-control" id="risques_associes" wire:model.defer="data.risques_associes">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.risques_associes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Maîtrise des risques associés à chaque équipement -->
                <div class="form-group">
                    <label for="maitrise_risques">59. Maîtrise des risques associés à chaque équipement</label>
                    <select class="form-control" id="maitrise_risques" wire:model.defer="data.maitrise_risques">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.maitrise_risques') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Les équipements sont en bon état de fonctionnement -->
                <div class="form-group">
                    <label for="etat_equipements">60. Les équipements sont en bon état de fonctionnement</label>
                    <input type="text" class="form-control" id="etat_equipements" wire:model.defer="data.etat_equipements" placeholder="Comment en assurer?">
                    @error('data.etat_equipements') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Propreté des équipements -->
                <div class="form-group">
                    <label for="proprete_equipements">61. Propreté des équipements</label>
                    <input type="text" class="form-control" id="proprete_equipements" wire:model.defer="data.proprete_equipements" placeholder="Comment assurer la propreté?">
                    @error('data.proprete_equipements') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Colonne de droite -->
            <div class="col-md-6">
                <!-- Plan de nettoyage des équipements -->
                <div class="form-group">
                    <label for="plan_nettoyage">62. Plan de nettoyage des équipements</label>
                    <select class="form-control" id="plan_nettoyage" wire:model.defer="data.plan_nettoyage">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.plan_nettoyage') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Fréquence de nettoyage des équipements -->
                <div class="form-group">
                    <label for="frequence_nettoyage">63. Fréquence de nettoyage des équipements</label>
                    <input type="text" class="form-control" id="frequence_nettoyage" wire:model.defer="data.frequence_nettoyage" placeholder="Ex: Quotidien, Hebdomadaire">
                    @error('data.frequence_nettoyage') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Plan d’assainissement des équipements -->
                <div class="form-group">
                    <label for="plan_assainissement">64. Plan d’assainissement des équipements</label>
                    <select class="form-control" id="plan_assainissement" wire:model.defer="data.plan_assainissement">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.plan_assainissement') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Types d’assainissement pratiqué -->
                <div class="form-group">
                    <label for="types_assainissement">65. Types d’assainissement pratiqué</label>
                    <input type="text" class="form-control" id="types_assainissement" wire:model.defer="data.types_assainissement" placeholder="Ex: Chimique, Thermique">
                    @error('data.types_assainissement') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Assainissement chimique (produits utilisés) -->
                <div class="form-group">
                    <label for="assainissement_chimique">66. Assainissement chimique (produits utilisés)</label>
                    <input type="text" class="form-control" id="assainissement_chimique" wire:model.defer="data.assainissement_chimique" placeholder="Liste des produits">
                    @error('data.assainissement_chimique') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Assainissement thermique -->
                <div class="form-group">
                    <label for="assainissement_thermique">67. Assainissement thermique</label>
                    <select class="form-control" id="assainissement_thermique" wire:model.defer="data.assainissement_thermique">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.assainissement_thermique') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Fréquence d’assainissement des équipements -->
                <div class="form-group">
                    <label for="frequence_assainissement">68. Fréquence d’assainissement des équipements</label>
                    <input type="text" class="form-control" id="frequence_assainissement" wire:model.defer="data.frequence_assainissement" placeholder="Ex: Mensuel">
                    @error('data.frequence_assainissement') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Bon entreposage des équipements -->
                <div class="form-group">
                    <label for="entreposage_equipements">69. Bon entreposage des équipements</label>
                    <select class="form-control" id="entreposage_equipements" wire:model.defer="data.entreposage_equipements">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.entreposage_equipements') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Boutons Précédent et Suivant -->
        <div class="d-flex justify-content-between">
            <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    </div>
@endif


@if ($currentStep === 6)
    <div>
        <h3>Étape 6: Environnement et Hygiène</h3>
        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <!-- Absence de sources externes de contamination -->
                <div class="form-group">
                    <label for="absence_sources_externes">70. Absence de sources externes de contamination</label>
                    <select class="form-control" id="absence_sources_externes" wire:model.defer="data.absence_sources_externes">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.absence_sources_externes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Absence de sources internes de contamination -->
                <div class="form-group">
                    <label for="absence_sources_internes">71. Absence de sources internes de contamination</label>
                    <select class="form-control" id="absence_sources_internes" wire:model.defer="data.absence_sources_internes">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.absence_sources_internes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Propreté des locaux -->
                <div class="form-group">
                    <label for="proprete_locaux">72. Propreté des locaux</label>
                    <select class="form-control" id="proprete_locaux" wire:model.defer="data.proprete_locaux">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.proprete_locaux') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Propreté des murs, planchers, portes, et fenêtres -->
                <div class="form-group">
                    <label for="proprete_surfaces">73. Propreté des murs, planchers, portes, et fenêtres</label>
                    <select class="form-control" id="proprete_surfaces" wire:model.defer="data.proprete_surfaces">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.proprete_surfaces') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Drainage adéquat du sol -->
                <div class="form-group">
                    <label for="drainage_sol">74. Drainage adéquat du sol</label>
                    <select class="form-control" id="drainage_sol" wire:model.defer="data.drainage_sol">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.drainage_sol') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Matériaux des murs et sols étanches -->
                <div class="form-group">
                    <label for="materiaux_surfaces">75. Matériaux des murs et sols étanches</label>
                    <select class="form-control" id="materiaux_surfaces" wire:model.defer="data.materiaux_surfaces">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.materiaux_surfaces') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Colonne de droite -->
            <div class="col-md-6">
                <!-- Plafonds conçus pour minimiser la saleté -->
                <div class="form-group">
                    <label for="proprete_plafonds">76. Plafonds conçus pour minimiser la saleté</label>
                    <select class="form-control" id="proprete_plafonds" wire:model.defer="data.proprete_plafonds">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.proprete_plafonds') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Conditions de surface, ventilation, aération pour hygiène -->
                <div class="form-group">
                    <label for="conditions_hygiene">77. Conditions de surface, ventilation, aération pour hygiène</label>
                    <select class="form-control" id="conditions_hygiene" wire:model.defer="data.conditions_hygiene">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.conditions_hygiene') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Ventilation suffisante -->
                <div class="form-group">
                    <label for="ventilation">78. Ventilation suffisante</label>
                    <select class="form-control" id="ventilation" wire:model.defer="data.ventilation">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.ventilation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Gradient de pression -->
                <div class="form-group">
                    <label for="gradient_pression">79. Gradient de pression</label>
                    <select class="form-control" id="gradient_pression" wire:model.defer="data.gradient_pression">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.gradient_pression') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Bonne évacuation des buées -->
                <div class="form-group">
                    <label for="evacuation_boue">80. Bonne évacuation des buées</label>
                    <select class="form-control" id="evacuation_boue" wire:model.defer="data.evacuation_boue">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.evacuation_boue') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Absence de risques de contamination croisée -->
                <div class="form-group">
                    <label for="risque_contamination">81. Absence de risques de contamination croisée</label>
                    <select class="form-control" id="risque_contamination" wire:model.defer="data.risque_contamination">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.risque_contamination') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Absence de rongeurs et d’insectes dans l’établissement -->
                <div class="form-group">
                    <label for="rongeur_insecte">82. Absence de rongeurs et d’insectes dans l’établissement</label>
                    <select class="form-control" id="rongeur_insecte" wire:model.defer="data.rongeur_insecte">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.rongeur_insecte') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Plan de nettoyage -->
                <div class="form-group">
                    <label for="plan_nettoyagehygiene">83. Plan de nettoyage</label>
                    <select class="form-control" id="plan_nettoyagehygiene" wire:model.defer="data.plan_nettoyagehygiene">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.plan_nettoyagehygiene') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Bonne fréquence de nettoyage -->
                <div class="form-group">
                    <label for="frequence_nettoyagehygiene">84. Bonne fréquence de nettoyage</label>
                    <select class="form-control" id="frequence_nettoyagehygiene" wire:model.defer="data.frequence_nettoyagehygiene">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.frequence_nettoyagehygiene') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Plan d’assainissement -->
                <div class="form-group">
                    <label for="plan_assainissementhygiene">85. Plan d’assainissement</label>
                    <select class="form-control" id="plan_assainissementhygiene" wire:model.defer="data.plan_assainissementhygiene">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.plan_assainissementhygiene') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Bonne fréquence d’assainissement -->
                <div class="form-group">
                    <label for="frequence_assainissementhygiene">86. Bonne fréquence d’assainissement</label>
                    <select class="form-control" id="frequence_assainissementhygiene" wire:model.defer="data.frequence_assainissementhygiene">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.frequence_assainissementhygiene') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Type d’assainissement pratiqué -->
                <div class="form-group">
                    <label for="type_assainissementhygiene">87. Type d’assainissement pratiqué</label>
                    <input type="text" class="form-control" id="type_assainissementhygiene" wire:model.defer="data.type_assainissementhygiene" placeholder="Ex: Thermique, Chimique">
                    @error('data.type_assainissementhygiene') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Toilettes suffisantes et accessibles -->
                <div class="form-group">
                    <label for="toilette_accessible">88. Toilettes suffisantes et accessibles</label>
                    <select class="form-control" id="toilette_accessible" wire:model.defer="data.toilette_accessible">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.toilette_accessible') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Dispositifs de lavage et de désinfection des mains sont-ils complets ? -->
                <div class="form-group">
                    <label for="desinfection_main">89. Dispositifs de lavage et de désinfection des mains sont-ils complets ?</label>
                    <select class="form-control" id="desinfection_main" wire:model.defer="data.desinfection_main">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.desinfection_main') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Bonne gestion des déchets -->
                <div class="form-group">
                    <label for="gestion_dechethygiene">90. Bonne gestion des déchets</label>
                    <select class="form-control" id="gestion_dechethygiene" wire:model.defer="data.gestion_dechethygiene">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.gestion_dechethygiene') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Approvisionnement suffisant en eau potable avec pression adéquate -->
                <div class="form-group">
                    <label for="approvisionnement_pression">91. Approvisionnement suffisant en eau potable avec pression adéquate</label>
                    <select class="form-control" id="approvisionnement_pression" wire:model.defer="data.approvisionnement_pression">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.approvisionnement_pression') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Contrôle de la qualité de l’eau potable -->
                <div class="form-group">
                    <label for="control_qualite_eau">92. Contrôle de la qualité de l’eau potable</label>
                    <select class="form-control" id="control_qualite_eau" wire:model.defer="data.control_qualite_eau">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.control_qualite_eau') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Fréquence du contrôle de la qualité de l’eau potable -->
                <div class="form-group">
                    <label for="frequencecontrol_qualite">93. Fréquence du contrôle de la qualité de l’eau potable</label>
                    <input type="text" class="form-control" id="frequencecontrol_qualite" wire:model.defer="data.frequencecontrol_qualite" placeholder="Ex: Mensuel">
                    @error('data.frequencecontrol_qualite') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Disponibilité de registre ou certificat d’analyse de l’eau potable -->
                <div class="form-group">
                    <label for="certificat_analyseeau">94. Disponibilité de registre ou certificat d’analyse de l’eau potable</label>
                    <select class="form-control" id="certificat_analyseeau" wire:model.defer="data.certificat_analyseeau">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.certificat_analyseeau') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Bonne gestion des eaux usées -->
                <div class="form-group">
                    <label for="gestion_eauxuse">95. Bonne gestion des eaux usées</label>
                    <select class="form-control" id="gestion_eauxuse" wire:model.defer="data.gestion_eauxuse">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.gestion_eauxuse') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Boutons Précédent et Suivant -->
        <div class="d-flex justify-content-between">
            <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    </div>
@endif



@if ($currentStep === 7)
    <div>
        <h3>Étape 7: Personnel/Main-d'œuvre</h3>
        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <!-- Nombre d’employés -->
                <div class="form-group">
                    <label for="nombre_employes">104. Nombre d’employés</label>
                    <input type="number" class="form-control" id="nombre_employes" wire:model.defer="data.nombre_employes" placeholder="Ex: 50" required>
                    @error('data.nombre_employes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Répartition du personnel dans les différentes sections -->
                <div class="form-group">
                    <label for="repartition_personnel">105. Répartition du personnel dans les différentes sections de l’entreprise</label>
                    <input type="text" class="form-control" id="repartition_personnel" wire:model.defer="data.repartition_personnel" placeholder="Ex: 20 en production, 15 en vente,…">
                    @error('data.repartition_personnel') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Nombre de femmes -->
                <div class="form-group">
                    <label for="nombre_femmes">106. Nombre de femmes</label>
                    <input type="number" class="form-control" id="nombre_femmes" wire:model.defer="data.nombre_femmes" placeholder="Ex: 25">
                    @error('data.nombre_femmes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Ratio femmes/hommes (calculé automatiquement) -->
                <div class="form-group">
                    <label for="ratio_femmes_hommes">107. Ratio femmes/hommes</label>
                    <input type="text" class="form-control" id="ratio_femmes_hommes" wire:model="data.ratio_femmes_hommes" readonly>
                </div>

                <!-- Employés ayant une formation en Bonne Pratiques d’Hygiène (BPH) -->
                <div class="form-group">
                    <label for="formation_hygiene_personnel">108. Employés ayant une formation en Bonne Pratiques d’Hygiène (BPH)</label>
                    <input type="number" class="form-control" id="formation_hygiene_personnel" wire:model.defer="data.formation_hygiene_personnel" placeholder="Ex: 40">
                    @error('data.formation_hygiene_personnel') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Pourcentage des employés formés en BPH (calculé automatiquement) -->
                <div class="form-group">
                    <label for="pourcentage_forme_hygiene">109. Pourcentage des employés formés en BPH</label>
                    <input type="text" class="form-control" id="pourcentage_forme_hygiene" wire:model="data.pourcentage_forme_hygiene" readonly>
                </div>
            </div>

            <!-- Colonne de droite -->
            <div class="col-md-6">
                <!-- Autres formations des employés -->
                <div class="form-group">
                    <label for="autre_formationemploye">110. Autres formations des employés</label>
                    <input type="text" class="form-control" id="autre_formationemploye" wire:model.defer="data.autre_formationemploye" placeholder="Préciser et fournir certificats ou documents">
                    @error('data.autre_formationemploye') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Besoins de formation en BPH -->
                <div class="form-group">
                    <label for="formation_pbh">111. Besoins de formation en BPH</label>
                    <select class="form-control" id="formation_pbh" wire:model.defer="data.formation_pbh">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.formation_pbh') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Nombre suffisant de vestiaires -->
                <div class="form-group">
                    <label for="suffisant_vestiaire">112. Nombre suffisant de vestiaires</label>
                    <select class="form-control" id="suffisant_vestiaire" wire:model.defer="data.suffisant_vestiaire">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.suffisant_vestiaire') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Vestiaire hommes et femmes séparés -->
                <div class="form-group">
                    <label for="vetiaire_homfem">113. Vestiaire hommes et femmes séparés</label>
                    <select class="form-control" id="vetiaire_homfem" wire:model.defer="data.vetiaire_homfem">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.vetiaire_homfem') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Nombre approprié de cabinets d'aisance -->
                <div class="form-group">
                    <label for="no_cabinetaisance">114. Nombre approprié de cabinets d'aisance</label>
                    <select class="form-control" id="no_cabinetaisance" wire:model.defer="data.no_cabinetaisance">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.no_cabinetaisance') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Cabinets séparés pour hommes et femmes -->
                <div class="form-group">
                    <label for="cabinet_homfem">115. Cabinets séparés pour hommes et femmes</label>
                    <select class="form-control" id="cabinet_homfem" wire:model.defer="data.cabinet_homfem">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.cabinet_homfem') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Cabinets équipés de décharge d’eau automatique -->
                <div class="form-group">
                    <label for="cabinet_equipe">116. Cabinets équipés de décharge d’eau automatique</label>
                    <select class="form-control" id="cabinet_equipe" wire:model.defer="data.cabinet_equipe">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.cabinet_equipe') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Cabinets ne s’ouvrant pas sur les locaux de travail -->
                <div class="form-group">
                    <label for="cabinet_aisance">117. Cabinets ne s’ouvrant pas sur les locaux de travail</label>
                    <select class="form-control" id="cabinet_aisance" wire:model.defer="data.cabinet_aisance">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.cabinet_aisance') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Disponibilités et répartition des installations de lavage des mains -->
                <div class="form-group">
                    <label for="disponibilite_repartition">118. Disponibilités et répartition des installations de lavage des mains</label>
                    <select class="form-control" id="disponibilite_repartition" wire:model.defer="data.disponibilite_repartition">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.disponibilite_repartition') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Fréquence de lavage des mains -->
                <div class="form-group">
                    <label for="frequence_lavgel">119. Fréquence de lavage des mains</label>
                    <select class="form-control" id="frequence_lavgel" wire:model.defer="data.frequence_lavgel">
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                    @error('data.frequence_lavgel') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Boutons Précédent et Suivant -->
        <div class="d-flex justify-content-between">
            <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    </div>
@endif
@if ($currentStep === 8)
    <div>
        <h3>Étape 8: Autres Remarques (Facultatif)</h3>
        <div class="row">
            <div class="col-md-12">
                <!-- Checkbox pour activer la section de remarques -->
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="enable_remarques" wire:model="enable_remarques">
                    <label class="form-check-label" for="enable_remarques">Ajouter des remarques</label>
                </div>

                <!-- Section de Remarques -->
                @if ($enable_remarques)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>Élément évalué</th>
                                <th>Remarque</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['remarques'] as $index => $remarque)
                                <tr wire:key="remarque-{{ $index }}">
                                    <td>
                                        <select class="form-control" wire:model.defer="data.remarques.{{ $index }}.section">
                                            <option value="">Sélectionner</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section }}">{{ $section }}</option>
                                            @endforeach
                                        </select>
                                        @error('data.remarques.' . $index . '.section') 
                                            <span class="text-danger">{{ $message }}</span> 
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" wire:model.defer="data.remarques.{{ $index }}.element_evalue" placeholder="Élément évalué">
                                        @error('data.remarques.' . $index . '.element_evalue') 
                                            <span class="text-danger">{{ $message }}</span> 
                                        @enderror
                                    </td>
                                    <td>
                                        <textarea class="form-control" wire:model.defer="data.remarques.{{ $index }}.remarque" placeholder="Remarque"></textarea>
                                        @error('data.remarques.' . $index . '.remarque') 
                                            <span class="text-danger">{{ $message }}</span> 
                                        @enderror
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" wire:click="removeRemarque({{ $index }})">Supprimer</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Messages d'erreur globaux pour les remarques -->
                    @error('data.remarques.*.section') 
                        <span class="text-danger">Section est requise.</span> 
                    @enderror
                    @error('data.remarques.*.element_evalue') 
                        <span class="text-danger">Élément évalué est requis.</span> 
                    @enderror
                    @error('data.remarques.*.remarque') 
                        <span class="text-danger">Remarque est requise.</span> 
                    @enderror

                    <!-- Bouton pour ajouter une remarque -->
                    @if (count($data['remarques']) < 7)
                        <button type="button" class="btn btn-outline-primary mb-2" wire:click="addRemarque()">Ajouter une remarque</button>
                    @else
                        <span class="text-muted">Limite de 7 remarques atteinte.</span>
                    @endif
                @endif
            </div>
        </div>

        <!-- Boutons Précédent et Suivant -->
        <div class="d-flex justify-content-between">
            <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    </div>
@endif

@if ($currentStep === 9)
    <div>
        <h3>Étape 9: Signature & Aperçu</h3>
        
        <!-- Affichage des Inspecteurs Assignés -->
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

        <div class="row">

            <!-- Colonne de droite -->
            <div class="col-md-6">
                <!-- Signature du Chef de Brigade -->
                <div class="form-group">
                    <label>134. Signature du Chef de Brigade</label>
                    <p>{{ optional($inspection->chefDeBrigade)->nom }} {{ optional($inspection->chefDeBrigade)->prenom }}</p>
                </div>

                <!-- Date de la signature -->
                <div class="form-group">
                    <label>135. Date de la signature</label>
                    <p>{{ date('d-m-Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Boutons Précédent et Suivant -->
        <div class="d-flex justify-content-between">
            <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button type="button" wire:click="nextStep" class="btn btn-primary">Suivant</button>
        </div>
    </div>
@endif


@if ($currentStep === 10)
    <div>
        <h3>Étape 10: Aperçu des Informations Saisies</h3>
        <div class="card mb-3">
            <div class="card-header">
                <h4>Identification de l’entreprise</h4>
            </div>
            <div class="card-body">
                <p><strong>Type ou catégorie d’entreprise:</strong> {{ $data['type_entreprise'] }}</p>
                <p><strong>Propriétaire ou responsable:</strong> {{ $data['proprietaire'] }}</p>
                <p><strong>Téléphone:</strong> {{ $data['telephone'] }}</p>
                <p><strong>Email:</strong> {{ $data['email'] }}</p>
                <p><strong>L’entreprise est régulièrement enregistrée au MCI:</strong> {{ $data['entreprise_enregistree'] }}</p>
                @if ($data['entreprise_enregistree'] === 'Oui')
                    <p><strong>Numéro d’Identification Professionnelle:</strong> {{ $data['numero_identification'] }}</p>
                @endif
                <p><strong>L’entreprise a d’autres autorisations de fonctionnement:</strong> {{ $data['autres_autorisations'] }}</p>
                <p><strong>Numéro de patente:</strong> {{ $data['numero_patente'] }}</p>
                <p><strong>Coordonnées GPS:</strong> {{ $data['coordonnees_gps'] }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h4>Production et Intrants</h4>
            </div>
            <div class="card-body">
                <p><strong>Intrants entrant dans la production:</strong> {{ $data['intrants_matiere'] }}</p>
                <p><strong>Les intrants sont bien étiquetés:</strong> {{ $data['etiquetage_intrants'] }}</p>
                <p><strong>Intrants conformes:</strong> {{ $data['conformite_intrants'] }}</p>
                <p><strong>Intrants retraçables:</strong> {{ $data['tracabilite_intrants'] }}</p>
                <p><strong>Exigences relatives aux intrants:</strong> {{ $data['exigences_intrants'] }}</p>
                <p><strong>Existence de dispositifs de contrôle à la réception:</strong> {{ $data['controle_reception'] }}</p>
                <p><strong>Existence d’un registre de contrôle ou des certificats d’analyse:</strong> {{ $data['registre_controle'] }}</p>
                <p><strong>Les intrants subissent des traitements:</strong> {{ $data['traitement_intrants'] }}</p>
                <p><strong>Retour ou destruction d’intrants non conformes:</strong> {{ $data['retour_destruction_intrants'] }}</p>

                <h5 class="mt-4">Produits</h5>
                @foreach ($data['produits'] as $produit)
                    <p>
                        <strong>Produit:</strong> {{ $produit['nom'] }} |
                        <strong>Fréquence de production:</strong> {{ $produit['frequence'] }} |
                        <strong>Production journalière:</strong> {{ $produit['production_journaliere'] }} |
                        <strong>Vente journalière:</strong> {{ $produit['vente_journaliere'] }} |
                        <strong>Mode de vente:</strong> {{ $produit['mode_vente'] }}
                    </p>
                @endforeach

                <h5 class="mt-4">Étapes de Production et Risques Associés</h5>
                @foreach ($data['etapes'] as $etape)
                    <p>
                        <strong>Étape:</strong> {{ $etape['etape'] }} |
                        <strong>Risques associés:</strong> {{ $etape['risque_associe'] }} |
                        <strong>Maîtrise des risques:</strong> {{ $etape['maitrise_risques'] }}
                    </p>
                @endforeach
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h4>Contrôle de la Qualité</h4>
            </div>
            <div class="card-body">
                <p><strong>Système de qualité:</strong> {{ $data['systeme_qualite'] }}</p>
                <p><strong>Plan de qualité:</strong> {{ $data['plan_qualite'] }}</p>
                <p><strong>Techniciens qualifiés en contrôle de qualité:</strong> {{ $data['techniciens_qualifies'] }}</p>
                <p><strong>Certificats d’analyse à l’origine:</strong> {{ $data['certificats_analyse_origine'] }}</p>
                <p><strong>Tests réalisés sur les marchandises à la réception:</strong> {{ $data['tests_reception'] }}</p>
                <p><strong>Types de tests:</strong> {{ $data['types_tests'] }}</p>
                <p><strong>Fréquence des tests:</strong> {{ $data['frequence_tests'] }}</p>
                <p><strong>Laboratoire interne:</strong> {{ $data['laboratoire_interne'] }}</p>
                <p><strong>Laboratoire externe:</strong> {{ $data['laboratoire_externe'] }}</p>
                <p><strong>Registres ou certificats d’analyse disponibles:</strong> {{ $data['registres_analyse'] }}</p>
                <p><strong>Tests d’échantillons sur place par l’inspecteur:</strong> {{ $data['tests_echantillons'] }}</p>
                <p><strong>Date et heure du test:</strong> {{ $data['date_heure_test'] }}</p>
                <p><strong>Types de tests:</strong> {{ $data['type_test'] }}</p>
                <p><strong>Objectifs des tests:</strong> {{ $data['objectifs_tests'] }}</p>
                <p><strong>Résultats obtenus:</strong> {{ $data['resultats_obtenus'] }}</p>
                <p><strong>Les résultats sont-ils conformes aux normes ?:</strong> {{ $data['conformite_resultats'] }}</p>
                <p><strong>Échantillons prélevés:</strong> {{ $data['types_echantillons'] }}</p>
                <p><strong>Objectifs du prélèvement d’échantillons:</strong> {{ $data['objectifs_prelevement'] }}</p>
                <p><strong>Nombre d’échantillons prélevés:</strong> {{ $data['nombre_echantillons'] }}</p>
                <p><strong>Codage des échantillons:</strong> {{ $data['codage_echantillons'] }}</p>
            </div>
        </div>

        <!-- Ajoutez ici les autres sections (Étape 4 à 9) de manière similaire -->

        @if (!empty($data['remarques']) && $enable_remarques)
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Autres Remarques</h4>
                </div>
                <div class="card-body">
                    @foreach ($data['remarques'] as $remarque)
                        <p>
                            <strong>Section:</strong> {{ $remarque['section'] }}<br>
                            <strong>Élément évalué:</strong> {{ $remarque['element_evalue'] }}<br>
                            <strong>Remarque:</strong> {{ $remarque['remarque'] }}
                        </p>
                        <hr>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-header">
                <h4>Personnel/Main-d'œuvre</h4>
            </div>
            <div class="card-body">
                <p><strong>Nombre d’employés:</strong> {{ $data['nombre_employes'] }}</p>
                <p><strong>Répartition du personnel dans les différentes sections de l’entreprise:</strong> {{ $data['repartition_personnel'] }}</p>
                <p><strong>Nombre de femmes:</strong> {{ $data['nombre_femmes'] }}</p>
                <p><strong>Ratio femmes/hommes:</strong> {{ $data['ratio_femmes_hommes'] }}</p>
                <p><strong>Employés ayant une formation en Bonne Pratiques d’Hygiène (BPH):</strong> {{ $data['formation_hygiene_personnel'] }}</p>
                <p><strong>Pourcentage des employés formés en BPH:</strong> {{ $data['pourcentage_forme_hygiene'] }}</p>
                <p><strong>Autres formations des employés:</strong> {{ $data['autre_formationemploye'] }}</p>
                <p><strong>Besoins de formation en BPH:</strong> {{ $data['formation_pbh'] }}</p>
                <p><strong>Nombre suffisant de vestiaires:</strong> {{ $data['suffisant_vestiaire'] }}</p>
                <p><strong>Vestiaire hommes et femmes séparés:</strong> {{ $data['vetiaire_homfem'] }}</p>
                <p><strong>Nombre approprié de cabinets d'aisance:</strong> {{ $data['no_cabinetaisance'] }}</p>
                <p><strong>Cabinets séparés pour hommes et femmes:</strong> {{ $data['cabinet_homfem'] }}</p>
                <p><strong>Cabinets équipés de décharge d’eau automatique:</strong> {{ $data['cabinet_equipe'] }}</p>
                <p><strong>Cabinets ne s’ouvrant pas sur les locaux de travail:</strong> {{ $data['cabinet_aisance'] }}</p>
                <p><strong>Disponibilités et répartition des installations de lavage des mains:</strong> {{ $data['disponibilite_repartition'] }}</p>
                <p><strong>Fréquence de lavage des mains:</strong> {{ $data['frequence_lavgel'] }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h4>Environnement et Hygiène</h4>
            </div>
            <div class="card-body">
                <p><strong>Absence de sources externes de contamination:</strong> {{ $data['absence_sources_externes'] }}</p>
                <p><strong>Absence de sources internes de contamination:</strong> {{ $data['absence_sources_internes'] }}</p>
                <p><strong>Propreté des locaux:</strong> {{ $data['proprete_locaux'] }}</p>
                <p><strong>Propreté des murs, planchers, portes, et fenêtres:</strong> {{ $data['proprete_surfaces'] }}</p>
                <p><strong>Drainage adéquat du sol:</strong> {{ $data['drainage_sol'] }}</p>
                <p><strong>Matériaux des murs et sols étanches:</strong> {{ $data['materiaux_surfaces'] }}</p>
                <p><strong>Plafonds conçus pour minimiser la saleté:</strong> {{ $data['proprete_plafonds'] }}</p>
                <p><strong>Conditions de surface, ventilation, aération pour hygiène:</strong> {{ $data['conditions_hygiene'] }}</p>
                <p><strong>Ventilation suffisante:</strong> {{ $data['ventilation'] }}</p>
                <p><strong>Gradient de pression:</strong> {{ $data['gradient_pression'] }}</p>
                <p><strong>Bonne évacuation des buées:</strong> {{ $data['evacuation_boue'] }}</p>
                <p><strong>Absence de risques de contamination croisée:</strong> {{ $data['risque_contamination'] }}</p>
                <p><strong>Absence de rongeurs et d’insectes dans l’établissement:</strong> {{ $data['rongeur_insecte'] }}</p>
                <p><strong>Plan de nettoyage:</strong> {{ $data['plan_nettoyagehygiene'] }}</p>
                <p><strong>Bonne fréquence de nettoyage:</strong> {{ $data['frequence_nettoyagehygiene'] }}</p>
                <p><strong>Plan d’assainissement:</strong> {{ $data['plan_assainissementhygiene'] }}</p>
                <p><strong>Bonne fréquence d’assainissement:</strong> {{ $data['frequence_assainissementhygiene'] }}</p>
                <p><strong>Type d’assainissement pratiqué:</strong> {{ $data['type_assainissementhygiene'] }}</p>
                <p><strong>Toilettes suffisantes et accessibles:</strong> {{ $data['toilette_accessible'] }}</p>
                <p><strong>Dispositifs de lavage et de désinfection des mains sont-ils complets ?:</strong> {{ $data['desinfection_main'] }}</p>
                <p><strong>Bonne gestion des déchets:</strong> {{ $data['gestion_dechethygiene'] }}</p>
                <p><strong>Approvisionnement suffisant en eau potable avec pression adéquate:</strong> {{ $data['approvisionnement_pression'] }}</p>
                <p><strong>Contrôle de la qualité de l’eau potable:</strong> {{ $data['control_qualite_eau'] }}</p>
                <p><strong>Fréquence du contrôle de la qualité de l’eau potable:</strong> {{ $data['frequencecontrol_qualite'] }}</p>
                <p><strong>Disponibilité de registre ou certificat d’analyse de l’eau potable:</strong> {{ $data['certificat_analyseeau'] }}</p>
                <p><strong>Bonne gestion des eaux usées:</strong> {{ $data['gestion_eauxuse'] }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <h4>Signature & Aperçu</h4>
            </div>
            <div class="card-body">
                <p><strong>Chef de Brigade:</strong> {{ optional($inspection->chefDeBrigade)->nom }} {{ optional($inspection->chefDeBrigade)->prenom }}</p>
                <p><strong>Date de la signature:</strong> {{ date('d-m-Y') }}</p>
            </div>
        </div>

        <!-- Boutons Précédent et Soumettre -->
        <div class="d-flex justify-content-between mt-4">
            <button type="button" wire:click="prevStep" class="btn btn-secondary">Précédent</button>
            <button type="submit" class="btn btn-success">Soumettre</button>
        </div>
    </div>
@endif

        <!-- ... autres étapes ... -->
    </form>
</div>

