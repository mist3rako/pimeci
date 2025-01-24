<?php

namespace App\Livewire;

use App\Models\Inspection;
use App\Models\User; // Assurez-vous que ce modèle existe et est correctement configuré
use Livewire\Component;
use Livewire\WithFileUploads; // Si vous gérez des fichiers
use Illuminate\Support\Facades\Auth;

class FormulaireInspection extends Component
{
    use WithFileUploads; // Utilisé pour gérer les uploads de fichiers, y compris les signatures

    public $champId;
    public $inspectionId;
    public $inspection;
    public $currentStep = 1;

    // Variable pour activer la section des remarques
    public $enable_remarques = true;

    public $data = [
        // **Étape 1: Identification de l’entreprise**
        'type_entreprise' => '',
        'proprietaire' => '',
        'telephone' => '',
        'email' => '',
        'entreprise_enregistree' => '',
        'numero_identification' => '',
        'autres_autorisations' => '',
        'numero_patente' => '',
        'coordonnees_gps' => '',

        // **Étape 2: Production et Intrants**
        'intrants_matiere' => '',
        'etiquetage_intrants' => '',
        'conformite_intrants' => '',
        'tracabilite_intrants' => '',
        'exigences_intrants' => '',
        'controle_reception' => '',
        'registre_controle' => '',
        'traitement_intrants' => '',
        'retour_destruction_intrants' => '',
        'produits' => [
            ['nom' => '', 'frequence' => '', 'production_journaliere' => '', 'vente_journaliere' => '', 'mode_vente' => '']
        ],
        'etapes' => [
            ['etape' => '', 'risque_associe' => '', 'maitrise_risques' => '']
        ],

        // **Étape 3: Contrôle de la Qualité**
        'systeme_qualite' => '',
        'plan_qualite' => '',
        'techniciens_qualifies' => '',
        'certificats_analyse_origine' => '',
        'tests_reception' => '',
        'types_tests' => '',
        'frequence_tests' => '',
        'laboratoire_interne' => '',
        'laboratoire_externe' => '',
        'registres_analyse' => '',
        'tests_echantillons' => '',
        'date_heure_test' => '',
        'type_test' => '',
        'objectifs_tests' => '',
        'resultats_obtenus' => '',
        'conformite_resultats' => '',
        'types_echantillons' => '',
        'objectifs_prelevement' => '',
        'nombre_echantillons' => '',
        'codage_echantillons' => '',

        // **Étape 4: Emballage, Stockage, et Conditionnement**
        'types_conditionnement' => '',
        'etiquetage_produits' => '',
        'informations_etiquettes' => '',
        'quantite_nette' => '',
        'types_emballage' => '',
        'emballages_certifies' => '',
        'materiels_stockage' => '',
        'materiels_certifies' => '',
        'bonne_pratique_stockage' => '',
        'gestion_stocks' => '',
        'plan_rappel' => '',
        'experience_rappel' => '',

        // **Étape 5: Matériels/Équipements**
        'types_equipements' => '',
        'resistants_corrosion' => '',
        'risques_associes' => '',
        'maitrise_risques' => '',
        'etat_equipements' => '',
        'proprete_equipements' => '',
        'plan_nettoyage' => '',
        'frequence_nettoyage' => '',
        'plan_assainissement' => '',
        'types_assainissement' => '',
        'assainissement_chimique' => '',
        'assainissement_thermique' => '',
        'frequence_assainissement' => '',
        'entreposage_equipements' => '',

        // **Étape 6: Environnement et Hygiène**
        'absence_sources_externes' => '',
        'absence_sources_internes' => '',
        'proprete_locaux' => '',
        'proprete_surfaces' => '',
        'drainage_sol' => '',
        'materiaux_surfaces' => '',
        'proprete_plafonds' => '',
        'conditions_hygiene' => '',
        'ventilation' => '',
        'gradient_pression' => '',
        'evacuation_boue' => '',
        'risque_contamination' => '',
        'rongeur_insecte' => '',
        'plan_nettoyagehygiene' => '',
        'frequence_nettoyagehygiene' => '',
        'plan_assainissementhygiene' => '',
        'frequence_assainissementhygiene' => '',
        'type_assainissementhygiene' => '',
        'toilette_accessible' => '',
        'desinfection_main' => '',
        'gestion_dechethygiene' => '',
        'approvisionnement_pression' => '',
        'control_qualite_eau' => '',
        'frequencecontrol_qualite' => '',
        'certificat_analyseeau' => '',
        'gestion_eauxuse' => '',

        // **Étape 7: Personnel/Main-d'œuvre**
        'nombre_employes' => '',
        'repartition_personnel' => '',
        'nombre_femmes' => '',
        'ratio_femmes_hommes' => '',
        'formation_hygiene_personnel' => '',
        'pourcentage_forme_hygiene' => '',
        'autre_formationemploye' => '',
        'formation_pbh' => '',
        'suffisant_vestiaire' => '',
        'vetiaire_homfem' => '',
        'no_cabinetaisance' => '',
        'cabinet_homfem' => '',
        'cabinet_equipe' => '',
        'cabinet_aisance' => '',
        'disponibilite_repartition' => '',
        'frequence_lavgel' => '',

        // **Étape 8: Autres Remarques (Facultatif)**
        'remarques' => [
            ['section' => '', 'element_evalue' => '', 'remarque' => '']
        ],

        // **Étape 9: Signature & Aperçu**
        'inspecteur_1' => '',
        'inspecteur_2' => '',
        'inspecteur_3' => '',
         // Stockera la signature en base64 ou en fichier ('owner_signature' => '',)
    ];

    // Règles de validation par étape
    protected $rules = [
        // **Étape 1**
        'data.type_entreprise' => 'required|string|max:255',
        'data.proprietaire' => 'required|string|max:255',
        'data.telephone' => ['required', 'regex:/^\(509\)\d{4}-\d{4}$/'], // Format: (509)XXXX-XXXX
        'data.email' => 'required|email|max:255',
        'data.entreprise_enregistree' => 'required|in:Oui,Non',
        'data.numero_identification' => 'required_if:data.entreprise_enregistree,Oui|nullable|regex:/^[A-Z]-\d{5}$/',
        'data.autres_autorisations' => 'required|in:Oui,Non',
        'data.numero_patente' => ['nullable', 'regex:/^\d{3}-\d{3}-\d{3}-\d$/', 'max:12'],
        'data.coordonnees_gps' => 'nullable|string|max:255',

        // **Étape 2**
        'data.intrants_matiere' => 'nullable|string|max:255',
        'data.etiquetage_intrants' => 'nullable|in:Oui,Non,NA',
        'data.conformite_intrants' => 'nullable|in:Oui,Non',
        'data.tracabilite_intrants' => 'nullable|in:Oui,Non',
        'data.exigences_intrants' => 'nullable|string|max:255',
        'data.controle_reception' => 'nullable|in:Oui,Non',
        'data.registre_controle' => 'nullable|in:Oui,Non',
        'data.traitement_intrants' => 'nullable|in:Oui,Non',
        'data.retour_destruction_intrants' => 'nullable|in:Oui,Non,NA',

        'data.produits.*.nom' => 'required|string|max:255',
        'data.produits.*.frequence' => 'nullable|string|max:255',
        'data.produits.*.production_journaliere' => 'nullable|numeric',
        'data.produits.*.vente_journaliere' => 'nullable|numeric',
        'data.produits.*.mode_vente' => 'nullable|string|max:255',

        'data.etapes.*.etape' => 'required|string|max:255',
        'data.etapes.*.risque_associe' => 'nullable|string|max:255',
        'data.etapes.*.maitrise_risques' => 'nullable|in:Oui,Non',

        // **Étape 3**
        'data.systeme_qualite' => 'nullable|in:Oui,Non',
        'data.plan_qualite' => 'nullable|in:Oui,Non',
        'data.techniciens_qualifies' => 'nullable|in:Oui,Non',
        'data.certificats_analyse_origine' => 'nullable|in:Oui,Non',
        'data.tests_reception' => 'nullable|in:Oui,Non',
        'data.types_tests' => 'nullable|string|max:255',
        'data.frequence_tests' => 'nullable|string|max:255',
        'data.laboratoire_interne' => 'nullable|in:Oui,Non',
        'data.laboratoire_externe' => 'nullable|in:Oui,Non',
        'data.registres_analyse' => 'nullable|in:Oui,Non',
        'data.tests_echantillons' => 'nullable|string|max:255',
        'data.date_heure_test' => 'nullable|date',
        'data.type_test' => 'nullable|in:Physico-chimique,Bactériologique,Organoleptique',
        'data.objectifs_tests' => 'nullable|string|max:255',
        'data.resultats_obtenus' => 'nullable|string|max:255',
        'data.conformite_resultats' => 'nullable|in:Oui,Non',
        'data.types_echantillons' => 'nullable|string|max:255',
        'data.objectifs_prelevement' => 'nullable|string|max:255',
        'data.nombre_echantillons' => 'nullable|integer|min:0',
        'data.codage_echantillons' => ['nullable', 'regex:/^MCI-\d{6}ET$/'],

        // **Étape 4**
        'data.types_conditionnement' => 'nullable|string|max:255',
        'data.etiquetage_produits' => 'nullable|in:Oui,Non,NA',
        'data.informations_etiquettes' => 'nullable|in:Oui,Non,NA',
        'data.quantite_nette' => 'nullable|in:Oui,Non,NA',
        'data.types_emballage' => 'nullable|string|max:255',
        'data.emballages_certifies' => 'nullable|in:Oui,Non',
        'data.materiels_stockage' => 'nullable|in:Oui,Non',
        'data.materiels_certifies' => 'nullable|in:Oui,Non',
        'data.bonne_pratique_stockage' => 'nullable|in:Oui,Non',
        'data.gestion_stocks' => 'nullable|in:Oui,Non',
        'data.plan_rappel' => 'nullable|in:Oui,Non',
        'data.experience_rappel' => 'nullable|in:Oui,Non',

        // **Étape 5**
        'data.types_equipements' => 'nullable|string|max:255',
        'data.resistants_corrosion' => 'nullable|in:Oui,Non',
        'data.risques_associes' => 'nullable|in:Oui,Non',
        'data.maitrise_risques' => 'nullable|in:Oui,Non',
        'data.etat_equipements' => 'nullable|string|max:255',
        'data.proprete_equipements' => 'nullable|string|max:255',
        'data.plan_nettoyage' => 'nullable|in:Oui,Non',
        'data.frequence_nettoyage' => 'nullable|string|max:255',
        'data.plan_assainissement' => 'nullable|in:Oui,Non',
        'data.types_assainissement' => 'nullable|string|max:255',
        'data.assainissement_chimique' => 'nullable|string|max:255',
        'data.assainissement_thermique' => 'nullable|in:Oui,Non',
        'data.frequence_assainissement' => 'nullable|string|max:255',
        'data.entreposage_equipements' => 'nullable|in:Oui,Non',

        // **Étape 6**
        'data.absence_sources_externes' => 'nullable|in:Oui,Non',
        'data.absence_sources_internes' => 'nullable|in:Oui,Non',
        'data.proprete_locaux' => 'nullable|in:Oui,Non',
        'data.proprete_surfaces' => 'nullable|in:Oui,Non',
        'data.drainage_sol' => 'nullable|in:Oui,Non',
        'data.materiaux_surfaces' => 'nullable|in:Oui,Non',
        'data.proprete_plafonds' => 'nullable|in:Oui,Non',
        'data.conditions_hygiene' => 'nullable|in:Oui,Non',
        'data.ventilation' => 'nullable|in:Oui,Non',
        'data.gradient_pression' => 'nullable|in:Oui,Non',
        'data.evacuation_boue' => 'nullable|in:Oui,Non',
        'data.risque_contamination' => 'nullable|in:Oui,Non',
        'data.rongeur_insecte' => 'nullable|in:Oui,Non',
        'data.plan_nettoyagehygiene' => 'nullable|in:Oui,Non',
        'data.frequence_nettoyagehygiene' => 'nullable|string|max:255',
        'data.plan_assainissementhygiene' => 'nullable|in:Oui,Non',
        'data.frequence_assainissementhygiene' => 'nullable|string|max:255',
        'data.type_assainissementhygiene' => 'nullable|string|max:255',
        'data.toilette_accessible' => 'nullable|in:Oui,Non',
        'data.desinfection_main' => 'nullable|in:Oui,Non',
        'data.gestion_dechethygiene' => 'nullable|in:Oui,Non',
        'data.approvisionnement_pression' => 'nullable|in:Oui,Non',
        'data.control_qualite_eau' => 'nullable|in:Oui,Non',
        'data.frequencecontrol_qualite' => 'nullable|string|max:255',
        'data.certificat_analyseeau' => 'nullable|in:Oui,Non',
        'data.gestion_eauxuse' => 'nullable|in:Oui,Non',

        // **Étape 7**
        'data.nombre_employes' => 'nullable|integer|min:0',
        'data.repartition_personnel' => 'nullable|string|max:255',
        'data.nombre_femmes' => 'nullable|integer|min:0',
        'data.ratio_femmes_hommes' => 'nullable|string|max:10',
        'data.formation_hygiene_personnel' => 'nullable|integer|min:0',
        'data.pourcentage_forme_hygiene' => 'nullable|string|max:10',
        'data.autre_formationemploye' => 'nullable|string|max:255',
        'data.formation_pbh' => 'nullable|in:Oui,Non',
        'data.suffisant_vestiaire' => 'nullable|in:Oui,Non',
        'data.vetiaire_homfem' => 'nullable|in:Oui,Non',
        'data.no_cabinetaisance' => 'nullable|in:Oui,Non',
        'data.cabinet_homfem' => 'nullable|in:Oui,Non',
        'data.cabinet_equipe' => 'nullable|in:Oui,Non',
        'data.cabinet_aisance' => 'nullable|in:Oui,Non',
        'data.disponibilite_repartition' => 'nullable|in:Oui,Non',
        'data.frequence_lavgel' => 'nullable|in:Oui,Non',

        // **Étape 8**
        'data.remarques.*.section' => 'required_with:data.remarques.*.element_evalue,data.remarques.*.remarque|string|max:255',
        'data.remarques.*.element_evalue' => 'required_with:data.remarques.*.section,data.remarques.*.remarque|string|max:255',
        'data.remarques.*.remarque' => 'required_with:data.remarques.*.section,data.remarques.*.element_evalue|string|max:500',

        // **Étape 9**
        'data.inspecteur_1' => 'nullable|exists:users,id',
        'data.inspecteur_2' => 'nullable|exists:users,id',
        'data.inspecteur_3' => 'nullable|exists:users,id',
        // Stockage en base64 ou autre format selon votre implémentation ( 'data.owner_signature' => 'nullable|string',)
    ];

    // Messages personnalisés pour les validations
    protected $messages = [
        'data.telephone.regex' => 'Le format du téléphone doit être (509)XXXX-XXXX.',
        'data.numero_identification.regex' => 'Le format doit être une lettre majuscule suivie d\'un tiret et de cinq chiffres (ex: X-12345).',
        'data.codage_echantillons.regex' => 'Le format doit être MCI-XXXXXXET (ex: MCI-140824ET).',
        // Ajoutez d'autres messages personnalisés si nécessaire
    ];

    public function mount($champId, $inspectionId)
    {
        $this->champId = $champId;
        $this->inspectionId = $inspectionId;

        // Charger les données de l'inspection avec les relations nécessaires
        $this->inspection = Inspection::with([
            'entreprise',
            'typeIntervention',
            'planificateurUser',
            'chefDeBrigade',
            'idUsers2',
            'idUsers3',
            'idUsers4',
            'champsInspection'
        ])->findOrFail($inspectionId);

        $this->initializeForm();
    }

    
    public function initializeForm()
    {
        // Initialiser les tableaux dynamiques avec une première ligne vide si nécessaire
        if (empty($this->data['produits'])) {
            $this->data['produits'] = [
                ['nom' => '', 'frequence' => '', 'production_journaliere' => '', 'vente_journaliere' => '', 'mode_vente' => '']
            ];
        }

        if (empty($this->data['etapes'])) {
            $this->data['etapes'] = [
                ['etape' => '', 'risque_associe' => '', 'maitrise_risques' => '']
            ];
        }

        if (empty($this->data['remarques'])) {
            $this->data['remarques'] = [
                ['section' => '', 'element_evalue' => '', 'remarque' => '']
            ];
        }

        // Si vous chargez des données existantes, vous pouvez les assigner ici
        if ($this->inspection) {
            // Exemple: Assigner les données de l'inspection au formulaire
            // Vous devez ajuster ces assignations selon votre modèle Inspection
            $this->data['type_entreprise'] = $this->inspection->type_entreprise ?? '';
            // Continuez à assigner tous les champs nécessaires
            // ...
        }
    }

    public function updated($propertyName)
    {
        // Validation en temps réel
        $this->validateOnly($propertyName);
    
        // Calcul des champs automatiques
        if (in_array($propertyName, ['data.nombre_femmes', 'data.nombre_employes'])) {
            $this->calculateRatioFemmesHommes();
        }
    
        if (in_array($propertyName, ['data.formation_hygiene_personnel', 'data.nombre_employes'])) {
            $this->calculatePourcentageFormeHygiene();
        }
    }

    // Méthode pour calculer le ratio femmes/hommes
    public function calculateRatioFemmesHommes()
    {
        $nombre_femmes = $this->data['nombre_femmes'] ?? 0;
        $nombre_hommes = ($this->data['nombre_employes'] ?? 0) - $nombre_femmes;

        if ($nombre_hommes > 0) {
            $ratio = ($nombre_femmes / $nombre_hommes) * 100;
            $this->data['ratio_femmes_hommes'] = number_format($ratio, 2) . '%';
        } else {
            $this->data['ratio_femmes_hommes'] = 'N/A';
        }
    }

    // Méthode pour calculer le pourcentage des employés formés en BPH
    public function calculatePourcentageFormeHygiene()
    {
        $formation = $this->data['formation_hygiene_personnel'] ?? 0;
        $total = $this->data['nombre_employes'] ?? 0;

        if ($total > 0) {
            $pourcentage = ($formation / $total) * 100;
            $this->data['pourcentage_forme_hygiene'] = number_format($pourcentage, 2) . '%';
        } else {
            $this->data['pourcentage_forme_hygiene'] = 'N/A';
        }
    }

    public function nextStep()
    {
        // $this->validateStep(); // Désactivé temporairement pour le débogage
    
        if ($this->currentStep < 10) {
            $this->currentStep++;
        }
    }
    

    public function prevStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    // Gestion des produits
    public function addProduct()
    {
        if (count($this->data['produits']) < 10) { // Limite à 10 produits
            $this->data['produits'][] = [
                'nom' => '',
                'frequence' => '',
                'production_journaliere' => '',
                'vente_journaliere' => '',
                'mode_vente' => '',
            ];
        }
    }

    public function removeProduct($index)
    {
        if (isset($this->data['produits'][$index])) {
            unset($this->data['produits'][$index]);
            $this->data['produits'] = array_values($this->data['produits']);
        }
    }

    // Gestion des étapes de production et risques
    public function addEtape()
    {
        if (count($this->data['etapes']) < 10) { // Limite à 10 étapes
            $this->data['etapes'][] = [
                'etape' => '',
                'risque_associe' => '',
                'maitrise_risques' => '',
            ];
        }
    }

    public function removeEtape($index)
    {
        if (isset($this->data['etapes'][$index])) {
            unset($this->data['etapes'][$index]);
            $this->data['etapes'] = array_values($this->data['etapes']);
        }
    }

    // Gestion des remarques
    public function addRemarque()
    {
        if (count($this->data['remarques']) < 10) { // Limite à 10 remarques
            $this->data['remarques'][] = [
                'section' => '',
                'element_evalue' => '',
                'remarque' => '',
            ];
        }
    }

    public function removeRemarque($index)
    {
        if (isset($this->data['remarques'][$index])) {
            unset($this->data['remarques'][$index]);
            $this->data['remarques'] = array_values($this->data['remarques']);
        }
    }

    // Méthode pour valider les champs de l'étape actuelle
    public function validateStep()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'data.type_entreprise' => 'required|string|max:255',
                    'data.proprietaire' => 'required|string|max:255',
                    'data.telephone' => ['required', 'regex:/^\(509\)\d{4}-\d{4}$/'],
                    'data.email' => 'required|email|max:255',
                    'data.entreprise_enregistree' => 'required|in:Oui,Non',
                    'data.numero_identification' => 'required_if:data.entreprise_enregistree,Oui|nullable|regex:/^[A-Z]-\d{5}$/',
                    'data.autres_autorisations' => 'required|in:Oui,Non',
                    'data.numero_patente' => ['nullable', 'regex:/^\d{3}-\d{3}-\d{3}-\d$/', 'max:13'],
                    'data.coordonnees_gps' => 'nullable|string|max:255',
                ]);
                break;

            case 2:
                $this->validate([
                    'data.intrants_matiere' => 'nullable|string|max:255',
                    'data.etiquetage_intrants' => 'nullable|in:Oui,Non,NA',
                    'data.conformite_intrants' => 'nullable|in:Oui,Non',
                    'data.tracabilite_intrants' => 'nullable|in:Oui,Non',
                    'data.exigences_intrants' => 'nullable|string|max:255',
                    'data.controle_reception' => 'nullable|in:Oui,Non',
                    'data.registre_controle' => 'nullable|in:Oui,Non',
                    'data.traitement_intrants' => 'nullable|in:Oui,Non',
                    'data.retour_destruction_intrants' => 'nullable|in:Oui,Non,NA',

                    'data.produits.*.nom' => 'required|string|max:255',
                    'data.produits.*.frequence' => 'nullable|string|max:255',
                    'data.produits.*.production_journaliere' => 'nullable|numeric',
                    'data.produits.*.vente_journaliere' => 'nullable|numeric',
                    'data.produits.*.mode_vente' => 'nullable|string|max:255',

                    'data.etapes.*.etape' => 'required|string|max:255',
                    'data.etapes.*.risque_associe' => 'nullable|string|max:255',
                    'data.etapes.*.maitrise_risques' => 'nullable|in:Oui,Non',
                ]);
                break;

            case 3:
                $this->validate([
                    'data.systeme_qualite' => 'nullable|in:Oui,Non',
                    'data.plan_qualite' => 'nullable|in:Oui,Non',
                    'data.techniciens_qualifies' => 'nullable|in:Oui,Non',
                    'data.certificats_analyse_origine' => 'nullable|in:Oui,Non',
                    'data.tests_reception' => 'nullable|in:Oui,Non',
                    'data.types_tests' => 'nullable|string|max:255',
                    'data.frequence_tests' => 'nullable|string|max:255',
                    'data.laboratoire_interne' => 'nullable|in:Oui,Non',
                    'data.laboratoire_externe' => 'nullable|in:Oui,Non',
                    'data.registres_analyse' => 'nullable|in:Oui,Non',
                    'data.tests_echantillons' => 'nullable|string|max:255',
                    'data.date_heure_test' => 'nullable|date',
                    'data.type_test' => 'nullable|in:Physico-chimique,Bactériologique,Organoleptique',
                    'data.objectifs_tests' => 'nullable|string|max:255',
                    'data.resultats_obtenus' => 'nullable|string|max:255',
                    'data.conformite_resultats' => 'nullable|in:Oui,Non',
                    'data.types_echantillons' => 'nullable|string|max:255',
                    'data.objectifs_prelevement' => 'nullable|string|max:255',
                    'data.nombre_echantillons' => 'nullable|integer|min:0',
                    'data.codage_echantillons' => ['nullable', 'regex:/^MCI-\d{6}ET$/'],
                ]);
                break;

            case 4:
                $this->validate([
                    'data.types_conditionnement' => 'nullable|string|max:255',
                    'data.etiquetage_produits' => 'nullable|in:Oui,Non,NA',
                    'data.informations_etiquettes' => 'nullable|in:Oui,Non,NA',
                    'data.quantite_nette' => 'nullable|in:Oui,Non,NA',
                    'data.types_emballage' => 'nullable|string|max:255',
                    'data.emballages_certifies' => 'nullable|in:Oui,Non',
                    'data.materiels_stockage' => 'nullable|in:Oui,Non',
                    'data.materiels_certifies' => 'nullable|in:Oui,Non',
                    'data.bonne_pratique_stockage' => 'nullable|in:Oui,Non',
                    'data.gestion_stocks' => 'nullable|in:Oui,Non',
                    'data.plan_rappel' => 'nullable|in:Oui,Non',
                    'data.experience_rappel' => 'nullable|in:Oui,Non',
                ]);
                break;

            case 5:
                $this->validate([
                    'data.types_equipements' => 'nullable|string|max:255',
                    'data.resistants_corrosion' => 'nullable|in:Oui,Non',
                    'data.risques_associes' => 'nullable|in:Oui,Non',
                    'data.maitrise_risques' => 'nullable|in:Oui,Non',
                    'data.etat_equipements' => 'nullable|string|max:255',
                    'data.proprete_equipements' => 'nullable|string|max:255',
                    'data.plan_nettoyage' => 'nullable|in:Oui,Non',
                    'data.frequence_nettoyage' => 'nullable|string|max:255',
                    'data.plan_assainissement' => 'nullable|in:Oui,Non',
                    'data.types_assainissement' => 'nullable|string|max:255',
                    'data.assainissement_chimique' => 'nullable|string|max:255',
                    'data.assainissement_thermique' => 'nullable|in:Oui,Non',
                    'data.frequence_assainissement' => 'nullable|string|max:255',
                    'data.entreposage_equipements' => 'nullable|in:Oui,Non',
                ]);
                break;

            case 6:
                $this->validate([
                    'data.absence_sources_externes' => 'nullable|in:Oui,Non',
                    'data.absence_sources_internes' => 'nullable|in:Oui,Non',
                    'data.proprete_locaux' => 'nullable|in:Oui,Non',
                    'data.proprete_surfaces' => 'nullable|in:Oui,Non',
                    'data.drainage_sol' => 'nullable|in:Oui,Non',
                    'data.materiaux_surfaces' => 'nullable|in:Oui,Non',
                    'data.proprete_plafonds' => 'nullable|in:Oui,Non',
                    'data.conditions_hygiene' => 'nullable|in:Oui,Non',
                    'data.ventilation' => 'nullable|in:Oui,Non',
                    'data.gradient_pression' => 'nullable|in:Oui,Non',
                    'data.evacuation_boue' => 'nullable|in:Oui,Non',
                    'data.risque_contamination' => 'nullable|in:Oui,Non',
                    'data.rongeur_insecte' => 'nullable|in:Oui,Non',
                    'data.plan_nettoyagehygiene' => 'nullable|in:Oui,Non',
                    'data.frequence_nettoyagehygiene' => 'nullable|string|max:255',
                    'data.plan_assainissementhygiene' => 'nullable|in:Oui,Non',
                    'data.frequence_assainissementhygiene' => 'nullable|string|max:255',
                    'data.type_assainissementhygiene' => 'nullable|string|max:255',
                    'data.toilette_accessible' => 'nullable|in:Oui,Non',
                    'data.desinfection_main' => 'nullable|in:Oui,Non',
                    'data.gestion_dechethygiene' => 'nullable|in:Oui,Non',
                    'data.approvisionnement_pression' => 'nullable|in:Oui,Non',
                    'data.control_qualite_eau' => 'nullable|in:Oui,Non',
                    'data.frequencecontrol_qualite' => 'nullable|string|max:255',
                    'data.certificat_analyseeau' => 'nullable|in:Oui,Non',
                    'data.gestion_eauxuse' => 'nullable|in:Oui,Non',
                ]);
                break;

            case 7:
                $this->validate([
                    'data.nombre_employes' => 'nullable|integer|min:0',
                    'data.repartition_personnel' => 'nullable|string|max:255',
                    'data.nombre_femmes' => 'nullable|integer|min:0',
                    'data.formation_hygiene_personnel' => 'nullable|integer|min:0',
                    'data.pourcentage_forme_hygiene' => 'nullable|string|max:10',
                    'data.autre_formationemploye' => 'nullable|string|max:255',
                    'data.formation_pbh' => 'nullable|in:Oui,Non',
                    'data.suffisant_vestiaire' => 'nullable|in:Oui,Non',
                    'data.vetiaire_homfem' => 'nullable|in:Oui,Non',
                    'data.no_cabinetaisance' => 'nullable|in:Oui,Non',
                    'data.cabinet_homfem' => 'nullable|in:Oui,Non',
                    'data.cabinet_equipe' => 'nullable|in:Oui,Non',
                    'data.cabinet_aisance' => 'nullable|in:Oui,Non',
                    'data.disponibilite_repartition' => 'nullable|in:Oui,Non',
                    'data.frequence_lavgel' => 'nullable|in:Oui,Non',
                ]);
                break;

            case 8:
                if ($this->enable_remarques) {
                    $this->validate([
                        'data.remarques.*.section' => 'required_with:data.remarques.*.element_evalue,data.remarques.*.remarque|string|max:255',
                        'data.remarques.*.element_evalue' => 'required_with:data.remarques.*.section,data.remarques.*.remarque|string|max:255',
                        'data.remarques.*.remarque' => 'required_with:data.remarques.*.section,data.remarques.*.element_evalue|string|max:500',
                    ]);
                }
                break;

            case 9:
                $this->validate([
                    'data.inspecteur_1' => 'nullable|exists:users,id',
                    'data.inspecteur_2' => 'nullable|exists:users,id',
                    'data.inspecteur_3' => 'nullable|exists:users,id',
                   // 'data.owner_signature' => 'required|string', // Assurez-vous que la signature est bien capturée en tant que string (base64)
                ]);
                break;

            default:
                // Aucun cas par défaut
                break;
        }
    }

    public function render()
    {
        return view('livewire.forms.form4', [
            'inspectors' => User::where('role_as', 'inspecteur')->get(), // Ajustez selon votre logique de rôles
            'sections' => $this->getSections(), // Méthode pour obtenir les sections disponibles
        ]);
    }

    // Méthode pour obtenir les sections disponibles pour les remarques
    private function getSections()
    {
        // Définissez vos sections ici ou récupérez-les depuis une table de la base de données
        return [
            'Étape 1: Identification de l’entreprise',
            'Étape 2: Production et Intrants',
            'Étape 3: Contrôle de la Qualité',
            'Étape 4: Emballage, Stockage, et Conditionnement',
            'Étape 5: Matériels/Équipements',
            'Étape 6: Environnement et Hygiène',
            'Étape 7: Personnel/Main-d\'œuvre',
            // Ajoutez d'autres sections si nécessaire
        ];
    }

    // Méthode pour soumettre le formulaire
    public function submit()
    {
        // Valider toutes les données
        $this->validate();
    
        // Récupérer ou créer l'inspection
        $inspection = Inspection::find($this->inspectionId);
        if (!$inspection) {
            $inspection = new Inspection();
            $inspection->id = $this->inspectionId;
            // Associez d'autres relations si nécessaire
        }
    
        // **Étape 1: Identification de l’entreprise**
        $inspection->type_entreprise = $this->data['type_entreprise'];
        $inspection->proprietaire = $this->data['proprietaire'];
        $inspection->telephone = $this->data['telephone'];
        $inspection->email = $this->data['email'];
        $inspection->entreprise_enregistree = $this->data['entreprise_enregistree'];
        $inspection->numero_identification = $this->data['numero_identification'];
        $inspection->autres_autorisations = $this->data['autres_autorisations'];
        $inspection->numero_patente = $this->data['numero_patente'];
        $inspection->coordonnees_gps = $this->data['coordonnees_gps'];
    
        // **Étape 2: Production et Intrants**
        $inspection->intrants_matiere = $this->data['intrants_matiere'];
        $inspection->etiquetage_intrants = $this->data['etiquetage_intrants'];
        $inspection->conformite_intrants = $this->data['conformite_intrants'];
        $inspection->tracabilite_intrants = $this->data['tracabilite_intrants'];
        $inspection->exigences_intrants = $this->data['exigences_intrants'];
        $inspection->controle_reception = $this->data['controle_reception'];
        $inspection->registre_controle = $this->data['registre_controle'];
        $inspection->traitement_intrants = $this->data['traitement_intrants'];
        $inspection->retour_destruction_intrants = $this->data['retour_destruction_intrants'];
    
        // **Étape 3: Contrôle de la Qualité**
        $inspection->systeme_qualite = $this->data['systeme_qualite'];
        $inspection->plan_qualite = $this->data['plan_qualite'];
        $inspection->techniciens_qualifies = $this->data['techniciens_qualifies'];
        $inspection->certificats_analyse_origine = $this->data['certificats_analyse_origine'];
        $inspection->tests_reception = $this->data['tests_reception'];
        $inspection->types_tests = $this->data['types_tests'];
        $inspection->frequence_tests = $this->data['frequence_tests'];
        $inspection->laboratoire_interne = $this->data['laboratoire_interne'];
        $inspection->laboratoire_externe = $this->data['laboratoire_externe'];
        $inspection->registres_analyse = $this->data['registres_analyse'];
        $inspection->tests_echantillons = $this->data['tests_echantillons'];
        $inspection->date_heure_test = $this->data['date_heure_test'] ? \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $this->data['date_heure_test']) : null;
        $inspection->type_test = $this->data['type_test'];
        $inspection->objectifs_tests = $this->data['objectifs_tests'];
        $inspection->resultats_obtenus = $this->data['resultats_obtenus'];
        $inspection->conformite_resultats = $this->data['conformite_resultats'];
        $inspection->types_echantillons = $this->data['types_echantillons'];
        $inspection->objectifs_prelevement = $this->data['objectifs_prelevement'];
        $inspection->nombre_echantillons = $this->data['nombre_echantillons'];
        $inspection->codage_echantillons = $this->data['codage_echantillons'];
    
        // **Étape 4: Emballage, Stockage, et Conditionnement**
        $inspection->types_conditionnement = $this->data['types_conditionnement'];
        $inspection->etiquetage_produits = $this->data['etiquetage_produits'];
        $inspection->informations_etiquettes = $this->data['informations_etiquettes'];
        $inspection->quantite_nette = $this->data['quantite_nette'];
        $inspection->types_emballage = $this->data['types_emballage'];
        $inspection->emballages_certifies = $this->data['emballages_certifies'];
        $inspection->materiels_stockage = $this->data['materiels_stockage'];
        $inspection->materiels_certifies = $this->data['materiels_certifies'];
        $inspection->bonne_pratique_stockage = $this->data['bonne_pratique_stockage'];
        $inspection->gestion_stocks = $this->data['gestion_stocks'];
        $inspection->plan_rappel = $this->data['plan_rappel'];
        $inspection->experience_rappel = $this->data['experience_rappel'];
    
        // **Étape 5: Matériels/Équipements**
        $inspection->types_equipements = $this->data['types_equipements'];
        $inspection->resistants_corrosion = $this->data['resistants_corrosion'];
        $inspection->risques_associes = $this->data['risques_associes'];
        $inspection->maitrise_risques = $this->data['maitrise_risques'];
        $inspection->etat_equipements = $this->data['etat_equipements'];
        $inspection->proprete_equipements = $this->data['proprete_equipements'];
        $inspection->plan_nettoyage = $this->data['plan_nettoyage'];
        $inspection->frequence_nettoyage = $this->data['frequence_nettoyage'];
        $inspection->plan_assainissement = $this->data['plan_assainissement'];
        $inspection->types_assainissement = $this->data['types_assainissement'];
        $inspection->assainissement_chimique = $this->data['assainissement_chimique'];
        $inspection->assainissement_thermique = $this->data['assainissement_thermique'];
        $inspection->frequence_assainissement = $this->data['frequence_assainissement'];
        $inspection->entreposage_equipements = $this->data['entreposage_equipements'];
    
        // **Étape 6: Environnement et Hygiène**
        $inspection->absence_sources_externes = $this->data['absence_sources_externes'];
        $inspection->absence_sources_internes = $this->data['absence_sources_internes'];
        $inspection->proprete_locaux = $this->data['proprete_locaux'];
        $inspection->proprete_surfaces = $this->data['proprete_surfaces'];
        $inspection->drainage_sol = $this->data['drainage_sol'];
        $inspection->materiaux_surfaces = $this->data['materiaux_surfaces'];
        $inspection->proprete_plafonds = $this->data['proprete_plafonds'];
        $inspection->conditions_hygiene = $this->data['conditions_hygiene'];
        $inspection->ventilation = $this->data['ventilation'];
        $inspection->gradient_pression = $this->data['gradient_pression'];
        $inspection->evacuation_boue = $this->data['evacuation_boue'];
        $inspection->risque_contamination = $this->data['risque_contamination'];
        $inspection->rongeur_insecte = $this->data['rongeur_insecte'];
        $inspection->plan_nettoyagehygiene = $this->data['plan_nettoyagehygiene'];
        $inspection->frequence_nettoyagehygiene = $this->data['frequence_nettoyagehygiene'];
        $inspection->plan_assainissementhygiene = $this->data['plan_assainissementhygiene'];
        $inspection->frequence_assainissementhygiene = $this->data['frequence_assainissementhygiene'];
        $inspection->type_assainissementhygiene = $this->data['type_assainissementhygiene'];
        $inspection->toilette_accessible = $this->data['toilette_accessible'];
        $inspection->desinfection_main = $this->data['desinfection_main'];
        $inspection->gestion_dechethygiene = $this->data['gestion_dechethygiene'];
        $inspection->approvisionnement_pression = $this->data['approvisionnement_pression'];
        $inspection->control_qualite_eau = $this->data['control_qualite_eau'];
        $inspection->frequencecontrol_qualite = $this->data['frequencecontrol_qualite'];
        $inspection->certificat_analyseeau = $this->data['certificat_analyseeau'];
        $inspection->gestion_eauxuse = $this->data['gestion_eauxuse'];
    
        // **Étape 7: Personnel/Main-d'œuvre**
        $inspection->nombre_employes = $this->data['nombre_employes'];
        $inspection->repartition_personnel = $this->data['repartition_personnel'];
        $inspection->nombre_femmes = $this->data['nombre_femmes'];
        $inspection->ratio_femmes_hommes = $this->data['ratio_femmes_hommes'];
        $inspection->formation_hygiene_personnel = $this->data['formation_hygiene_personnel'];
        $inspection->pourcentage_forme_hygiene = $this->data['pourcentage_forme_hygiene'];
        $inspection->autre_formationemploye = $this->data['autre_formationemploye'];
        $inspection->formation_pbh = $this->data['formation_pbh'];
        $inspection->suffisant_vestiaire = $this->data['suffisant_vestiaire'];
        $inspection->vetiaire_homfem = $this->data['vetiaire_homfem'];
        $inspection->no_cabinetaisance = $this->data['no_cabinetaisance'];
        $inspection->cabinet_homfem = $this->data['cabinet_homfem'];
        $inspection->cabinet_equipe = $this->data['cabinet_equipe'];
        $inspection->cabinet_aisance = $this->data['cabinet_aisance'];
        $inspection->disponibilite_repartition = $this->data['disponibilite_repartition'];
        $inspection->frequence_lavgel = $this->data['frequence_lavgel'];
    
        // **Étape 8: Autres Remarques (Facultatif)**
        // Supposons que vous stockez les remarques sous forme de JSON
        $inspection->remarques = $this->data['remarques'];
    
        // **Étape 9: Signature & Aperçu**
        $inspection->inspecteur_1 = $this->data['inspecteur_1'];
        $inspection->inspecteur_2 = $this->data['inspecteur_2'];
        $inspection->inspecteur_3 = $this->data['inspecteur_3'];
      //  $inspection->owner_signature = $this->data['owner_signature']; // Assurez-vous que la signature est stockée correctement
    
        // **Gestion des Relations Dynamiques**
    
        // **Produits**
        // Supposons que la relation est définie dans le modèle Inspection comme suit :
        // public function produits() { return $this->hasMany(Produit::class); }
        $inspection->produits()->delete(); // Supprimer les anciens produits
        foreach ($this->data['produits'] as $produitData) {
            $inspection->produits()->create([
                'nom' => $produitData['nom'],
                'frequence_production' => $produitData['frequence'],
                'production_journaliere' => $produitData['production_journaliere'],
                'vente_journaliere' => $produitData['vente_journaliere'],
                'mode_vente' => $produitData['mode_vente'],
            ]);
        }
    
        // **Étapes de Production et Risques**
        // Supposons que la relation est définie dans le modèle Inspection comme suit :
        // public function etapes() { return $this->hasMany(Etape::class); }
        $inspection->etapes()->delete(); // Supprimer les anciennes étapes
        foreach ($this->data['etapes'] as $etapeData) {
            $inspection->etapes()->create([
                'etape' => $etapeData['etape'],
                'risque_associe' => $etapeData['risque_associe'],
                'maitrise_risques' => $etapeData['maitrise_risques'],
            ]);
        }
    
        // **Remarques**
        // Supposons que vous stockez les remarques sous forme de JSON dans un champ `remarques_json`
        // Si vous avez une relation Remarque, vous pouvez gérer cela de manière similaire
        // Exemple avec JSON :
        $inspection->remarques_json = json_encode($this->data['remarques']);
    
        // **Gestion des Inspecteurs**
        // Supposons que les inspecteurs sont liés via des colonnes `inspecteur_1_id`, etc.
        $inspection->inspecteur_1_id = $this->data['inspecteur_1'];
        $inspection->inspecteur_2_id = $this->data['inspecteur_2'];
        $inspection->inspecteur_3_id = $this->data['inspecteur_3'];
    
        // **Gestion de la Signature**
        // Si vous utilisez un plugin de signature qui envoie la signature en base64, vous pouvez la stocker directement
        // Sinon, vous devrez peut-être gérer l'upload et le stockage des fichiers
        // Exemple de stockage base64 :
    //    if ($this->data['owner_signature']) {
            // Optionnel : Vous pouvez décoder et enregistrer l'image dans le stockage si nécessaire
            // $inspection->owner_signature = $this->data['owner_signature'];
    //    }
    
        // Enregistrer l'inspection
        $inspection->save();
    
        // Vous pouvez également gérer les relations supplémentaires ici
    
        // Optionnel: Réinitialiser le formulaire ou rediriger
        session()->flash('message', 'Inspection enregistrée avec succès.');
        return redirect()->route('inspections.index'); // Ajustez la route selon votre application
    }
    
}



