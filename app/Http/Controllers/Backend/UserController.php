<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Méthode index avec pagination, recherche et filtrage par direction
    public function index(Request $request)
    {
        $search = $request->input('search'); // Récupérer le terme de recherche s'il est présent
        $user = Auth::user(); // Récupérer l'utilisateur connecté

        // Si le super admin est connecté, il voit tous les utilisateurs
        if ($user->role_as === 'super_admin') {
            $users = User::where(function ($query) use ($search) {
                $query->where('nom', 'like', "%$search%")
                    ->orWhere('prenom', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('code_employe', 'like', "%$search%");
            })->paginate(10);
        } else {
            // Pour les autres admins, filtrer les utilisateurs de leur propre direction
            $role_prefix = str_replace('admin_', 'inspecteur_', $user->role_as); // Convertir admin_dci -> inspecteur_dci
            $users = User::where('role_as', $role_prefix)
                ->where(function ($query) use ($search) {
                    $query->where('nom', 'like', "%$search%")
                        ->orWhere('prenom', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('code_employe', 'like', "%$search%");
                })->paginate(10);
        }

        return view('backend.users.index', compact('users', 'search'));
    }

 // Afficher le formulaire de création d'un nouvel utilisateur
public function create()
{
    $user = Auth::user();
    $roles = [];

    // Déterminer les rôles en fonction du rôle de l'utilisateur connecté
    switch ($user->role_as) {
        case 'super_admin':
            $roles = [
                'super_admin' => 'Super Admin',
                'admin_dci' => 'Admin DCI',
                'admin_dcri' => 'Admin DCRI',
                'admin_dcqpc' => 'Admin DCQPC',
                'inspecteur_dci' => 'Inspecteur DCI',
                'inspecteur_dcri' => 'Inspecteur DCRI',
                'inspecteur_dcqpc' => 'Inspecteur DCQPC',
                'analyste' => 'Analyste'
            ];
            break;
        case 'admin_dci':
            $roles = [
                'inspecteur_dci' => 'Inspecteur DCI'
            ];
            break;
        case 'admin_dcri':
            $roles = [
                'inspecteur_dcri' => 'Inspecteur DCRI'
            ];
            break;
        case 'admin_dcqpc':
            $roles = [
                'inspecteur_dcqpc' => 'Inspecteur DCQPC'
            ];
            break;
    }

    // Liste des affectations disponibles
    $affectations = [
        'Chef de Section',
        'Inspecteur',
        'Technicien Junior',
        'Technicien Senior',
        'Assistant Directeur',
        'Directeur'
    ];

    return view('backend.users.create', compact('roles', 'affectations'));
}

    // Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'code_employe' => 'required|unique:users',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'user_name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role_as' => 'required|in:super_admin,admin_dci,admin_dcri,admin_dcqpc,inspecteur_dci,inspecteur_dcri,inspecteur_dcqpc,analyste',
            'sexe' => 'nullable|in:M,F',
            'affectation' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'no_plaque' => 'nullable|string|max:15',
            'statut' => 'required|in:activé,désactivé',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['password_confirmation']); // Exclure le champ `password_confirmation`
        $data['password'] = Hash::make($request->password); // Hachage du mot de passe

        // Gestion du téléchargement de l'image de profil
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_pic'] = $filename;
        }

        User::create($data); // Création de l'utilisateur dans la base de données

        return redirect()->route('users.index')->with('message', 'Utilisateur créé avec succès.');
    }

    // Afficher le formulaire d'édition d'un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
    
        // Définir les rôles basés sur l'utilisateur connecté
        $currentUser = Auth::user();
        $roles = [];
    
        switch ($currentUser->role_as) {
            case 'super_admin':
                $roles = [
                    'super_admin' => 'Super Admin',
                    'admin_dci' => 'Admin DCI',
                    'admin_dcri' => 'Admin DCRI',
                    'admin_dcqpc' => 'Admin DCQPC',
                    'inspecteur_dci' => 'Inspecteur DCI',
                    'inspecteur_dcri' => 'Inspecteur DCRI',
                    'inspecteur_dcqpc' => 'Inspecteur DCQPC',
                    'analyste' => 'Analyste'
                ];
                break;
            case 'admin_dci':
                $roles = [
                    'inspecteur_dci' => 'Inspecteur DCI'
                ];
                break;
            case 'admin_dcri':
                $roles = [
                    'inspecteur_dcri' => 'Inspecteur DCRI'
                ];
                break;
            case 'admin_dcqpc':
                $roles = [
                    'inspecteur_dcqpc' => 'Inspecteur DCQPC'
                ];
                break;
        }
    
        // Liste des affectations disponibles
        $affectations = [
            'Chef de Section',
            'Inspecteur',
            'Technicien Junior',
            'Technicien Senior',
            'Assistant Directeur',
            'Directeur'
        ];
    
        return view('backend.users.edit', compact('user', 'roles', 'affectations'));
    }

    // Mettre à jour un utilisateur existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'code_employe' => 'required|unique:users,code_employe,' . $id,
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'user_name' => 'required|string|unique:users,user_name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role_as' => 'required|in:super_admin,admin_dci,admin_dcri,admin_dcqpc,inspecteur_dci,inspecteur_dcri,inspecteur_dcqpc,analyste',
            'sexe' => 'nullable|in:M,F',
            'affectation' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'no_plaque' => 'nullable|string|max:15',
            'statut' => 'required|in:activé,désactivé',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);

        $data = $request->only([
            'code_employe',
            'nom',
            'prenom',
            'user_name',
            'email',
            'role_as',
            'sexe',
            'affectation',
            'phone',
            'no_plaque',
            'statut',
        ]);

        // Mise à jour du mot de passe si renseigné
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Gestion du téléchargement de l'image
        if ($request->hasFile('profile_pic')) {
            if ($user->profile_pic && File::exists(public_path('upload/admin_images/' . $user->profile_pic))) {
                File::delete(public_path('upload/admin_images/' . $user->profile_pic));
            }

            $file = $request->file('profile_pic');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_pic'] = $filename;
        }

        $user->update($data); // Mise à jour des données de l'utilisateur

        return redirect()->route('users.index')->with('message', 'Utilisateur mis à jour avec succès.');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Suppression de l'image de profil
        if ($user->profile_pic && File::exists(public_path('upload/admin_images/' . $user->profile_pic))) {
            File::delete(public_path('upload/admin_images/' . $user->profile_pic));
        }

        $user->delete(); // Suppression de l'utilisateur de la base de données

        return redirect()->route('users.index')->with('message', 'Utilisateur supprimé avec succès.');
    }
}
