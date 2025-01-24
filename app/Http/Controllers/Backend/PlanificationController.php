<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Planification;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\ChampsInspection;
use App\Models\TypeIntervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PlanificationController extends Controller
{
    // Afficher la liste des planifications avec pagination
    public function index()
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté
    
        // Vérifier le rôle de l'utilisateur et filtrer les planifications par direction
        if ($user->role_as == 'admin_dci') {
            $planifications = Planification::with([
                    'planificateurUser', 
                    'chefDeBrigade', 
                    'idUsers2', 
                    'idUsers3', 
                    'idUsers4', 
                    'entreprise', 
                    'champsInspection', 
                    'typeIntervention'
                ])
                ->where('planificateur', $user->id)  // Filtrer par ID de planificateur
                ->paginate(10);
        } elseif ($user->role_as == 'admin_dcri') {
            $planifications = Planification::with([
                    'planificateurUser', 
                    'chefDeBrigade', 
                    'idUsers2', 
                    'idUsers3', 
                    'idUsers4', 
                    'entreprise', 
                    'champsInspection', 
                    'typeIntervention'
                ])
                ->where('planificateur', $user->id)
                ->paginate(10);
        } elseif ($user->role_as == 'admin_dcqpc') {
            $planifications = Planification::with([
                    'planificateurUser', 
                    'chefDeBrigade', 
                    'idUsers2', 
                    'idUsers3', 
                    'idUsers4', 
                    'entreprise', 
                    'champsInspection', 
                    'typeIntervention'
                ])
                ->where('planificateur', $user->id)
                ->paginate(10);
        } else {
            // Super Admin voit toutes les planifications
            $planifications = Planification::with([
                    'planificateurUser', 
                    'chefDeBrigade', 
                    'idUsers2', 
                    'idUsers3', 
                    'idUsers4', 
                    'entreprise', 
                    'champsInspection', 
                    'typeIntervention'
                ])
                ->paginate(10);
        }
    
// Mettre à jour le statut des planifications expirées
foreach ($planifications as $planification) {
    // Vérifiez si l'inspection est planifiée ou en cours, et si la date d'inspection est dépassée
    if (Carbon::now()->gt($planification->date_inspection) && !in_array($planification->plan_progress_statut, ['Complète', 'En cours'])) {
        // Si l'inspection est expirée et n'est pas encore complétée ou en cours, mettez-la à "Expiré"
        $planification->plan_progress_statut = 'Expiré';
        $planification->save();
    }
}

    
        return view('backend.planifications.index', compact('planifications'));
    }

    // Afficher le formulaire de création de planification
    public function create()
    {
        // Sélectionner tous les inspecteurs disponibles
        $inspecteurs = User::whereIn('role_as', ['inspecteur_dci', 'inspecteur_dcri', 'inspecteur_dcqpc'])->get();

        // Récupérer les entreprises, champs d'inspection, et types d'intervention
        $entreprises = Entreprise::all();
        $champsInspections = ChampsInspection::all();
        $typeInterventions = TypeIntervention::all();

        // Retourner la vue avec les variables nécessaires
        return view('backend.planifications.create', compact('inspecteurs', 'entreprises', 'champsInspections', 'typeInterventions'));
    }

    // Enregistrer une nouvelle planification
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'id_users' => 'required|exists:users,id',
            'id_entreprises' => 'required|exists:entreprises,id',
            'id_champs_inspection' => 'required|exists:champs_inspections,id',
            'id_type_intervention' => 'required|exists:type_interventions,id',
            'plan_progress_statut' => 'required|in:Planifié,En cours,Complète,Expiré',
            'date_inspection' => 'required|date',  // Ajout de validation pour date_inspection
        ]);

        // Génération du code de planification unique
        $codePlanification = strtoupper(substr(md5(time()), 0, 4)) . date('mdy');

        // Création de la planification
        Planification::create([
            'planificateur' => Auth::id(),
            'id_users' => $request->id_users,
            'id_entreprises' => $request->id_entreprises,
            'id_champs_inspection' => $request->id_champs_inspection,
            'id_type_intervention' => $request->id_type_intervention,
            'plan_mission_code' => $codePlanification,
            'plan_progress_statut' => $request->plan_progress_statut,
            'date_inspection' => $request->date_inspection, // Ajout de date_inspection
        ]);

        return redirect()->route('planifications.index')->with('message', 'Planification créée avec succès.');
    }

    // Afficher le formulaire de modification d'une planification
    public function edit($id)
    {
        $planification = Planification::findOrFail($id);
        $users = User::whereIn('role_as', ['inspecteur_dci', 'inspecteur_dcri', 'inspecteur_dcqpc'])->get();
        $entreprises = Entreprise::all();
        $champs = ChampsInspection::all();
        $types = TypeIntervention::all();

        return view('backend.planifications.edit', compact('planification', 'users', 'entreprises', 'champs', 'types'));
    }

    // Mettre à jour une planification existante
    public function update(Request $request, $id)
    {
        $planification = Planification::findOrFail($id);

        // Validation des données
        $request->validate([
            'id_users' => 'required|exists:users,id',
            'id_entreprises' => 'required|exists:entreprises,id',
            'id_champs_inspection' => 'required|exists:champs_inspections,id',
            'id_type_intervention' => 'required|exists:type_interventions,id',
            'plan_progress_statut' => 'required|in:Planifié,En cours,Complète,Expiré',
            'date_inspection' => 'required|date',  // Ajout de validation pour date_inspection
        ]);

        // Mise à jour de la planification
        $planification->update([
            'id_users' => $request->id_users,
            'id_entreprises' => $request->id_entreprises,
            'id_champs_inspection' => $request->id_champs_inspection,
            'id_type_intervention' => $request->id_type_intervention,
            'plan_progress_statut' => $request->plan_progress_statut,
            'date_inspection' => $request->date_inspection,  // Ajout de date_inspection
        ]);

        return redirect()->route('planifications.index')->with('message', 'Planification mise à jour avec succès.');
    }

    // Supprimer une planification
    public function destroy($id)
    {
        $planification = Planification::findOrFail($id);
        $planification->delete();

        return redirect()->route('planifications.index')->with('message', 'Planification supprimée avec succès.');
    }

    // Afficher les détails d'une planification spécifique
    public function show($id)
    {
        $planification = Planification::with([
            'planificateurUser', 
            'chefDeBrigade', 
            'idUsers2', 
            'idUsers3', 
            'idUsers4', 
            'entreprise', 
            'champsInspection', 
            'typeIntervention'
        ])->findOrFail($id);

        return view('backend.planifications.show', compact('planification'));
    }
}
 