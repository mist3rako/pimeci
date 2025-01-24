<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\ChampsInspection;
use App\Models\TypeIntervention;
use App\Models\Planification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PlanificationCreate extends Component
{
    public $step = 1;

    public $id_type_intervention;
    public $id_entreprises;
    public $id_champs_inspection;

    public $id_users;
    public $id_users2;
    public $id_users3;
    public $id_users4;

    public $lieu_inspection;
    public $plan_mission_code;
    public $typeInterventions;
    public $entreprises;
    public $champsInspections;
    public $inspecteurs;
    public $admin_name;
    public $date_inspection;

    public function mount()
    {
        // Récupérer le rôle de l'utilisateur connecté
        $role = Auth::user()->role_as;
    
        // Filtrer les types d'intervention et champs d'inspection en fonction de la direction de l'utilisateur
        if ($role === 'admin_dci') {
            $this->typeInterventions = TypeIntervention::where('dir_type_insp', 'DCI')->get();
            $this->champsInspections = ChampsInspection::where('dir_champs_insp', 'DCI')->get();
        } elseif ($role === 'admin_dcri') {
            $this->typeInterventions = TypeIntervention::where('dir_type_insp', 'DCRI')->get();
            $this->champsInspections = ChampsInspection::where('dir_champs_insp', 'DCRI')->get();
        } elseif ($role === 'admin_dcqpc') {
            $this->typeInterventions = TypeIntervention::where('dir_type_insp', 'DCQPC')->get();
            $this->champsInspections = ChampsInspection::where('dir_champs_insp', 'DCQPC')->get();
        } else {
            // Si c'est un super_admin, récupérer tous les types d'intervention et champs d'inspection
            $this->typeInterventions = TypeIntervention::all();
            $this->champsInspections = ChampsInspection::all();
        }
    
        // Récupérer les entreprises et inspecteurs disponibles
        $this->entreprises = Entreprise::with('adresse')->get();
        $this->inspecteurs = User::whereIn('role_as', ['inspecteur_dci', 'inspecteur_dcri', 'inspecteur_dcqpc'])->get();
        $this->admin_name = Auth::user()->nom . ' ' . Auth::user()->prenom;
    
        // Initialiser la date d'inspection par défaut
        $this->date_inspection = now()->addDays(7)->format('Y-m-d\TH:i');
    }
    

    public function updatedIdEntreprises($value)
    {
        $entreprise = Entreprise::with('adresse')->find($value);
        if ($entreprise && $entreprise->adresse) {
            $this->lieu_inspection = $entreprise->rue . ', ' . $entreprise->adresse->commune . ', ' . $entreprise->adresse->departement;
        } else {
            $this->lieu_inspection = 'Adresse inconnue';
        }
    }

    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'id_type_intervention' => 'required',
                'id_entreprises' => 'required',
                'id_champs_inspection' => 'required',
                'id_users' => 'required',
                'date_inspection' => 'required|date',
            ]);

            $this->generatePlanMissionCode();
        }
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function generatePlanMissionCode()
    {
        $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
        $date = date('dmy');
        $this->plan_mission_code = $letters . $date;
    }

    public function getFormattedDate($date)
    {
        // Transformer la date en format français avec l'heure
        setlocale(LC_TIME, 'fr_FR.utf8'); // S'assurer que la localisation est en français
        return Carbon::parse($date)->translatedFormat('j F Y H:i A');
    }

    public function submit()
    {
        $this->validate([
            'id_type_intervention' => 'required',
            'id_entreprises' => 'required',
            'id_champs_inspection' => 'required',
            'id_users' => 'required',
            'date_inspection' => 'required|date',
        ]);

        Planification::create([
            'planificateur' => Auth::id(),
            'id_users' => $this->id_users,
            'id_users2' => $this->id_users2,
            'id_users3' => $this->id_users3,
            'id_users4' => $this->id_users4,
            'id_entreprises' => $this->id_entreprises,
            'id_champs_inspection' => $this->id_champs_inspection,
            'id_type_intervention' => $this->id_type_intervention,
            'plan_mission_code' => $this->plan_mission_code,
            'plan_progress_statut' => 'Planifié',
            'date_inspection' => $this->date_inspection,
        ]);

        session()->flash('message', 'Planification créée avec succès.');
        return redirect()->route('planifications.index');
    }

    public function render()
    {
        return view('livewire.planification-create');
    }

    public function index()
    {
        $user = Auth::user();  // Récupérer l'utilisateur connecté
        $planifications = [];
    
        // Filtrer les planifications en fonction du rôle et de l'ID de l'utilisateur connecté
        if ($user->role_as == 'admin_dci') {
            $planifications = Planification::where('planificateur', $user->id)
                ->whereHas('typeIntervention', function ($query) {
                    $query->where('dir_type_insp', 'DCI');
                })->paginate(10);
        } elseif ($user->role_as == 'admin_dcri') {
            $planifications = Planification::where('planificateur', $user->id)
                ->whereHas('typeIntervention', function ($query) {
                    $query->where('dir_type_insp', 'DCRI');
                })->paginate(10);
        } elseif ($user->role_as == 'admin_dcqpc') {
            $planifications = Planification::where('planificateur', $user->id)
                ->whereHas('typeIntervention', function ($query) {
                    $query->where('dir_type_insp', 'DCQPC');
                })->paginate(10);
        } else {
            // Si c'est un super_admin, récupérer toutes les planifications
            $planifications = Planification::with(['planificateurUser', 'chefDeBrigade', 'idUsers2', 'idUsers3', 'idUsers4', 'entreprise', 'champsInspection', 'typeIntervention'])
                ->paginate(10);
        }
    
        // Mettre à jour le statut des planifications expirées
        foreach ($planifications as $planification) {
            if (Carbon::now()->gt($planification->date_inspection)) {
                $planification->plan_progress_statut = 'Expiré';
                $planification->save();
            }
        }
    
        return view('backend.planifications.index', compact('planifications'));
    }

}
