<?php

namespace App\Http\Controllers\Backnd;

use App\Http\Controllers\Controller;
use App\Models\Inspection; // Importez le modèle Inspection
use Illuminate\Support\Facades\Auth;

class InspectionController extends Controller
{
    // Afficher la liste des inspections pour l'inspecteur
    public function index()
    {
        $userId = Auth::id(); 

        // Récupérer les inspections où l'utilisateur est impliqué
        $inspections = Inspection::where(function($query) use ($userId) {
                $query->where('id_users', $userId)
                      ->orWhere('id_users2', $userId)
                      ->orWhere('id_users3', $userId)
                      ->orWhere('id_users4', $userId);
            })
            ->with(['entreprise', 'typeIntervention', 'planificateurUser', 'chefDeBrigade']) // Charger les relations 
            ->paginate(10); // Utiliser paginate ici

        return view('backnd.inspections.index', compact('inspections')); // Mise à jour du chemin de la vue
    }

    // Afficher les détails d'une inspection
    public function show($id)
    {
        $inspection = Inspection::with([
            'entreprise',
            'typeIntervention',
            'planificateurUser',
            'chefDeBrigade',
            'idUsers2',
            'idUsers3',
            'idUsers4',
            'champsInspection'
        ])->findOrFail($id);

// Si l'inspection est en statut "Planifié" et que c'est le chef de brigade, changez-le en "En cours"
if ($inspection->plan_progress_statut === 'Planifié' && $inspection->chefDeBrigade->id === Auth::id()) {
    $inspection->plan_progress_statut = 'En cours';
    $inspection->save();
}


        return view('backnd.inspections.show', compact('inspection'));
    }

    public function startInspection($id)
    {
        $inspection = Inspection::findOrFail($id);
    
        // Mettre à jour le statut de l'inspection
        $inspection->plan_progress_statut = 'En cours';
        $inspection->save();
    
        // Rediriger vers le formulaire approprié avec les deux paramètres
        return redirect()->route('inspecteur.forms.start', [
            'champId' => $inspection->id_champs_inspection,
            'inspectionId' => $inspection->plan_mission_code
        ]); 
    }
    
    public function historiques()
    {
        $userId = Auth::id(); // Obtenez l'ID de l'inspecteur connecté
    
        // Récupérer les inspections avec le statut 'Complète' et où l'utilisateur est impliqué
        $inspections = Inspection::where('plan_progress_statut', 'Complète')
            ->where(function($query) use ($userId) {
                $query->where('id_users', $userId)
                      ->orWhere('id_users2', $userId)
                      ->orWhere('id_users3', $userId)
                      ->orWhere('id_users4', $userId);
            })
            ->with(['entreprise', 'typeIntervention', 'planificateurUser', 'chefDeBrigade']) // Charger les relations nécessaires
            ->paginate(10); // Utiliser paginate pour la pagination
    
        // Retourner la vue 'historiques' avec les inspections filtrées
        return view('backnd.inspections.historiques', compact('inspections'));
    }
    
    

    public function enterprises()
    {
        return view('backnd.inspections.entreprises', compact('inspections'));

    }

    public function statistiques()
    {
        return view('backnd.inspections.statistiques', compact('inspections'));

    }
    
    
}
