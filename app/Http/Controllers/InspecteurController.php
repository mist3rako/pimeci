<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class InspecteurController extends Controller 
{
    /**
     * Affiche le tableau de bord de l'inspecteur.
     */
    public function InspecteurDashboard()
    {
        return view('inspecteur.index');
    }

    /**
     * Déconnecte l'inspecteur.
     */
    public function InspecteurLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('inspecteur/login');
    }

    /**
     * Affiche le formulaire de connexion de l'inspecteur.
     */
    public function InspecteurLogin()
    {
        return view('inspecteur.inspecteur_login');
    }

    /**
     * Affiche le profil de l'inspecteur.
     */
    public function InspecteurProfile()
    {
        $profileData = Auth::user();
        return view('inspecteur.inspecteur_profile_view', compact('profileData'));
    }

    /**
     * Met à jour le profil de l'inspecteur, y compris la photo de profil.
     */
    public function InspecteurProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        // Validation des données
        $request->validate([
            'user_name'   => 'required|string|max:255|unique:users,user_name,' . $id,
            'nom'         => 'required|string|max:255',
            'prenom'      => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:users,email,' . $id,
            'phone'       => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Mise à jour des informations de l'utilisateur
        $data->user_name = $request->user_name;
        $data->nom       = $request->nom;
        $data->prenom    = $request->prenom;
        $data->email     = $request->email;
        $data->phone     = $request->phone;

        // Gestion du téléchargement de la photo de profil
        if ($request->hasFile('profile_pic')) {
            // Chemin du dossier de stockage des images
            $destinationPath = public_path('upload/admin_images/');

            // Supprimer l'ancienne photo si elle existe
            if ($data->profile_pic && File::exists($destinationPath . $data->profile_pic)) {
                File::delete($destinationPath . $data->profile_pic);
            }

            // Enregistrer la nouvelle photo
            $file      = $request->file('profile_pic');
            $filename  = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $data->profile_pic = $filename;
        }

        $data->save();

        // Configuration de la notification
        $notification = [
            'message'    => 'Profil mis à jour avec succès.',
            'alert-type' => 'success',
        ];

        return redirect()->route('inspecteur.profile')->with($notification);
    }

    /**
     * Affiche le formulaire pour changer le mot de passe de l'inspecteur.
     */
    public function InspecteurChangePassword()
    {
        $id          = Auth::user()->id;
        $profileData = User::find($id);
        return view('inspecteur.inspecteur_change_password', compact('profileData'));
    }

    /**
     * Met à jour le mot de passe de l'inspecteur.
     */
    public function InspecteurUpdatePassword(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'old_password'          => 'required',
            'new_password'          => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        // Vérification de l'ancien mot de passe
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'L’ancien mot de passe est incorrect.']);
        }

        // Mise à jour du mot de passe
        $user           = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Configuration de la notification
        $notification = [
            'message'    => 'Mot de passe mis à jour avec succès.',
            'alert-type' => 'success',
        ];

        return redirect()->route('inspecteur.dashboard')->with($notification);
    }
}
