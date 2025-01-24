<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entreprise;
use App\Models\Planification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer le filtre de la requête (par défaut à 'month' si non défini)
        $filter = $request->input('filter', 'month');

        // Récupérer le nombre total d'utilisateurs
        $totalUsers = User::count();

        // Récupérer le nombre total d'entreprises
        $totalEnterprises = Entreprise::count();

        // Récupérer le nombre total de planifications
        $totalPlanifications = Planification::count();

        // Récupérer les entreprises groupées par date de création
        $entreprises = Entreprise::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Extraire les données pour les graphiques des entreprises
        $enterpriseCounts = $entreprises->pluck('count');
        $dates = $entreprises->pluck('date');

        // Calcul de la croissance des entreprises sur le dernier jour
        $previousDayTotal = $enterpriseCounts->count() > 1 ? $enterpriseCounts[$enterpriseCounts->count() - 2] : 0;
        $latestCount = $enterpriseCounts->last();
        $growthPercentage = ($previousDayTotal > 0) ? (($latestCount - $previousDayTotal) / $previousDayTotal) * 100 : 0;
        $growthChange = round($growthPercentage, 2);

        // Récupérer les utilisateurs groupés par date de création
        $users = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Extraire les données pour les graphiques des utilisateurs
        $userCounts = $users->pluck('count');
        $userDates = $users->pluck('date');

        // Calcul de la croissance des utilisateurs sur le dernier jour
        $previousUserTotal = $userCounts->count() > 1 ? $userCounts[$userCounts->count() - 2] : 0;
        $latestUserCount = $userCounts->last();
        $userGrowthPercentage = ($previousUserTotal > 0) ? (($latestUserCount - $previousUserTotal) / $previousUserTotal) * 100 : 0;
        $userGrowthChange = round($userGrowthPercentage, 2);

        // Récupérer les planifications groupées par date de création
        $planifications = Planification::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Extraire les données pour les graphiques des planifications
        $planificationCounts = $planifications->pluck('count');
        $planificationDates = $planifications->pluck('date');

        // Calcul de la croissance des planifications sur le dernier jour
        $previousPlanificationTotal = $planificationCounts->count() > 1 ? $planificationCounts[$planificationCounts->count() - 2] : 0;
        $latestPlanificationCount = $planificationCounts->last();
        $planificationGrowthPercentage = ($previousPlanificationTotal > 0) ? (($latestPlanificationCount - $previousPlanificationTotal) / $previousPlanificationTotal) * 100 : 0;
        $planificationGrowthChange = round($planificationGrowthPercentage, 2);

        // Récupérer les planifications par statut
        $planificationStatuts = Planification::selectRaw('DATE(created_at) as date, plan_progress_statut, COUNT(*) as count')
            ->groupBy('date', 'plan_progress_statut')
            ->orderBy('date')
            ->get();

        // Filtrer les planifications selon les statuts
        $planifieCounts = $planificationStatuts->where('plan_progress_statut', 'Planifié')->pluck('count');
        $enCoursCounts = $planificationStatuts->where('plan_progress_statut', 'En cours')->pluck('count');
        $completeCounts = $planificationStatuts->where('plan_progress_statut', 'Complète')->pluck('count');
        $expireCounts = $planificationStatuts->where('plan_progress_statut', 'Expiré')->pluck('count');

        // Envoyer les données à la vue avec le filtre
        return view('admin.index', compact(
            'totalUsers', 'totalEnterprises', 'totalPlanifications',
            'growthChange', 'enterpriseCounts', 'dates',
            'userCounts', 'userDates', 'userGrowthChange',
            'planificationCounts', 'planificationDates', 'planificationGrowthChange',
            'filter', 'planifieCounts', 'enCoursCounts', 'completeCounts', 'expireCounts'
        ));
    }

    
}
