<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalysteController;
use App\Http\Controllers\InspecteurController;
use App\Http\Controllers\Backend\ChampsInspectionController;
use App\Http\Controllers\Backend\TypeInterventionController;
use App\Http\Controllers\Backend\EntrepriseController;
use App\Http\Controllers\Backnd\EntreprisesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PlanificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Backnd\InspectionController;
use App\Http\Controllers\Backnd\FormController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordController;


// Route pour afficher le formulaire de réinitialisation du mot de passe
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Route pour envoyer le lien de réinitialisation par e-mail
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/test-email', [ForgotPasswordController::class, 'testEmail']);


Route::get('/', function () {
    return view('welcome');
});

// Cette route redirige les utilisateurs connectés vers leur tableau de bord spécifique
Route::get('/dashboard', function () {
    $user = auth()->user();
    switch ($user->role_as) {
        case 'admin_dci':
        case 'admin_dcri':
        case 'admin_dcqpc':
        case 'super_admin':
            return redirect('admin/dashboard');
        case 'inspecteur_dci':
        case 'inspecteur_dcri':
        case 'inspecteur_dcqpc':
            return redirect('inspecteur/dashboard');
        case 'analyste':
            return redirect('analyste/dashboard');
        default:
            return redirect('/');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour le profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

Route::get('password/reset', [PasswordController::class, 'request'])->name('password.request');
Route::post('password/email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [PasswordController::class, 'reset'])->name('password.reset');
Route::post('password/reset', [PasswordController::class, 'update'])->name('password.update');

// Routes pour les administrateurs
Route::middleware(['auth', 'role:admin_dci|admin_dcri|admin_dcqpc|super_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    
    // Séparez les routes pour GET et POST pour changer le mot de passe
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/change/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    
    // Routes pour Champs Inspection avec vérification de la direction et restriction aux super_admin pour les modifications
    Route::controller(ChampsInspectionController::class)->group(function () {
        Route::get('/admin/champs-inspection', 'index')->middleware('check.direction')->name('champs.inspection.index');
        Route::get('/admin/champs-inspection/create', 'create')->middleware(['check.direction', 'role:super_admin'])->name('champs.inspection.create');
        Route::post('/admin/champs-inspection/store', 'store')->middleware(['check.direction', 'role:super_admin'])->name('champs.inspection.store');
        Route::get('/admin/champs-inspection/edit/{id}', 'edit')->middleware(['check.direction', 'role:super_admin'])->name('champs.inspection.edit');
        Route::post('/admin/champs-inspection/update/{id}', 'update')->middleware(['check.direction', 'role:super_admin'])->name('champs.inspection.update');
        Route::delete('/admin/champs-inspection/destroy/{id}', 'destroy')->middleware(['check.direction', 'role:super_admin'])->name('champs.inspection.destroy');
    });

    // Routes pour Types d'Intervention avec vérification de la direction et restriction aux super_admin pour les modifications
    Route::controller(TypeInterventionController::class)->group(function () {
        Route::get('/admin/types-intervention', 'indextype')->middleware('check.direction')->name('types.intervention.indextype');
        Route::get('/admin/types-intervention/create', 'createtype')->middleware(['check.direction', 'role:super_admin'])->name('types.intervention.createtype');
        Route::post('/admin/types-intervention/store', 'storetype')->middleware(['check.direction', 'role:super_admin'])->name('types.intervention.storetype');
        Route::get('/admin/types-intervention/edit/{id}', 'edittype')->middleware(['check.direction', 'role:super_admin'])->name('types.intervention.edittype');
        Route::post('/admin/types-intervention/update/{id}', 'updatetype')->middleware(['check.direction', 'role:super_admin'])->name('types.intervention.updatetype');
        Route::delete('/admin/types-intervention/destroy/{id}', 'destroytype')->middleware(['check.direction', 'role:super_admin'])->name('types.intervention.destroytype');
    });

    // Routes pour les entreprises
    Route::controller(EntrepriseController::class)->group(function () {
        Route::get('/admin/entreprises', 'index')->name('entreprises.index');
        Route::get('/admin/entreprises/create', 'create')->name('entreprises.create');
        Route::post('/admin/entreprises/store', 'store')->name('entreprises.store');
        Route::get('/admin/entreprises/edit/{id}', 'edit')->name('entreprises.edit');
        Route::post('/admin/entreprises/update/{id}', 'update')->name('entreprises.update');
        Route::delete('/admin/entreprises/destroy/{id}', 'destroy')->name('entreprises.destroy');
        Route::get('/admin/entreprises/confirm-delete/{id}', [EntrepriseController::class, 'confirmDelete'])->name('entreprises.confirmDelete');
        Route::get('/communes/{departement}', [EntrepriseController::class, 'getCommunes']);
        Route::put('/admin/entreprises/update/{id}', [EntrepriseController::class, 'update'])->name('entreprises.update');
        Route::get('/entreprise/{id}/adresse', [EntrepriseController::class, 'getAdresse']);
    });

    // Routes pour la gestion des utilisateurs
    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'index')->middleware('check.direction')->name('users.index');
        Route::get('/admin/users/create', 'create')->middleware('check.direction')->name('users.create');
        Route::post('/admin/users/store', 'store')->middleware('check.direction')->name('users.store');
        Route::get('/admin/users/edit/{id}', 'edit')->middleware('check.direction')->name('users.edit');
        Route::put('/admin/users/update/{id}', 'update')->middleware('check.direction')->name('users.update');
        Route::delete('/admin/users/destroy/{id}', 'destroy')->middleware('check.direction')->name('users.destroy');
    });

    // Routes pour les planifications avec vérification de la direction
    Route::middleware(['auth', 'check.direction'])->controller(PlanificationController::class)->group(function () {
        Route::get('/admin/planifications', 'index')->name('planifications.index');
        Route::get('/admin/planifications/create', 'create')->name('planifications.create');
        Route::post('/admin/planifications/store', 'store')->name('planifications.store');
        Route::get('/admin/planifications/show/{id}', 'show')->name('planifications.show');
        Route::get('/admin/planifications/edit/{id}', 'edit')->name('planifications.edit');
        Route::put('/admin/planifications/update/{id}', 'update')->name('planifications.update');
        Route::delete('/admin/planifications/destroy/{id}', 'destroy')->name('planifications.destroy');
        Route::get('/admin/planifications/confirm-delete/{id}', [PlanificationController::class, 'confirmDelete'])->name('planifications.confirmDelete');
    });

    // Routes pour dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

});

// Routes pour les analystes
Route::middleware(['auth', 'role:analyste'])->group(function () {
    Route::get('/analyste/dashboard', [AnalysteController::class, 'AnalysteDashboard'])->name('analyste.dashboard');
    Route::post('/analyste/logout', [AnalysteController::class, 'AnalysteLogout'])->name('analyste.logout');

    Route::get('/analyste/profile', [AnalysteController::class, 'AnalysteProfile'])->name('analyste.profile');
    Route::post('/analyste/profile/update', [AnalysteController::class, 'AnalysteProfileUpdate'])->name('analyste.profile.update');

    // Routes pour changer le mot de passe
    Route::get('/analyste/change/password', [AnalysteController::class, 'AnalysteChangePassword'])->name('analyste.change.password');
    Route::post('/analyste/update/password', [AnalysteController::class, 'AnalysteUpdatePassword'])->name('analyste.update.password');
});

// Routes pour les inspecteurs
Route::middleware(['auth', 'role:inspecteur_dci|inspecteur_dcri|inspecteur_dcqpc'])->group(function () {
    Route::get('/inspecteur/dashboard', [InspecteurController::class, 'InspecteurDashboard'])->name('inspecteur.dashboard');
    Route::post('/inspecteur/logout', [InspecteurController::class, 'InspecteurLogout'])->name('inspecteur.logout');
    Route::get('/inspecteur/profile', [InspecteurController::class, 'InspecteurProfile'])->name('inspecteur.profile');
    Route::post('/inspecteur/profile/update', [InspecteurController::class, 'InspecteurProfileUpdate'])->name('inspecteur.profile.update');

          //  Routes pour les entreprises
        Route::controller(EntreprisesController::class)->group(function () {
            Route::get('/inspecteur/inspections/entreprises', 'index')->name('entreprise.index');
            Route::get('/inspecteur/inspections/entreprises/create', 'create')->name('entreprise.create');
            Route::post('/inspecteur/inspections/entreprises/store', 'store')->name('entreprise.store');
            Route::get('/inspecteur/inspections/entreprises/edit/{id}', 'edit')->name('entreprise.edit');
            Route::delete('/inspecteur/inspections/entreprises/destroy/{id}', 'destroy')->name('entreprise.destroy');
            Route::get('/inspecteur/inspections/entreprises/confirm-delete/{id}', 'confirmDelete')->name('entreprise.confirmDelete');
        });
 
    // Routes pour changer le mot de passe
    Route::get('/inspecteur/change/password', [InspecteurController::class, 'InspecteurChangePassword'])->name('inspecteur.change.password');
    Route::post('/inspecteur/update/password', [InspecteurController::class, 'InspecteurUpdatePassword'])->name('inspecteur.update.password');

    // Routes pour gérer les inspections
    Route::get('/inspections', [InspectionController::class, 'index'])->name('inspecteur.inspections.index');
    Route::get('/inspecteur/inspections/historiques', [InspectionController::class, 'historiques'])->name('inspecteur.inspections.historiques');
    Route::get('/inspecteur/inspections/statistiques', [InspectionController::class, 'statistiques'])->name('inspecteur.inspections.statistiques');
    Route::get('/inspecteur/inspections/entreprises', [EntreprisesController::class, 'index'])->name('inspecteur.inspections.entreprises');
    Route::get('/inspecteur/inspections/show/{id}', [InspectionController::class, 'show'])->name('inspecteur.inspections.show');
    
    // Route pour démarrer l'inspection
    Route::get('/inspecteur/inspections/start/{id}', [InspectionController::class, 'startInspection'])->name('inspecteur.inspections.start');

    // Route pour afficher le formulaire de démarrage de l'inspection
    Route::get('/inspecteur/forms/show/{id}', [FormController::class, 'show'])->name('inspecteur.forms.show');
    // Route pour démarrer l'inspection et afficher le formulaire
    Route::get('/inspecteur/forms/start/{champId}/{inspectionId}', [FormController::class, 'startInspection'])->name('inspecteur.forms.start');

    // Route pour soumettre le formulaire
    Route::post('/form', [FormController::class, 'store'])->name('form.store');

    Route::get('/form4', function () {
        return view('backnd.forms.form4');
    })->name('form4');  
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/inspecteur/login', [InspecteurController::class, 'InspecteurLogin'])->name('inspecteur.login');
Route::get('/analyste/login', [AnalysteController::class, 'AnalysteLogin'])->name('analyste.login');