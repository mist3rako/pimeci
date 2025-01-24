<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Assurez-vous que c'est la bonne façade
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    } 

    public function AdminLogout(Request $request) {
        Auth::guard('web')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/admin/login');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));
    }

    public function AdminProfileUpdate(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->user_name = $request->user_name;
        $data->nom = $request->nom;
        $data->prenom = $request->prenom;
        $data->email = $request->email;
        $data->phone = $request->phone;
        
        if ($request->hasFile('profile_pic')){
            // Suppression de l'ancienne image s'il y en a une
            if ($data->profile_pic && File::exists(public_path('upload/admin_images/' . $data->profile_pic))) {
                File::delete(public_path('upload/admin_images/' . $data->profile_pic));
            }

            $file = $request->file('profile_pic');
            $filename = date('YmdHi').'_'. $file->getClientOriginalName(); 
            $file->move(public_path('upload/admin_images'), $filename);
            $data->profile_pic = $filename;
        }
        
        $data->save();
        
        // Configuration de la notification
        $notification = array(
            'message' => 'Profil mis à jour avec succès.',
            'alert-type' => 'success',
        );
        
        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }
    
    public function AdminUpdatePassword(Request $request){
        // Validation des données du formulaire
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
    
        // Vérification de l'ancien mot de passe
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'L’ancien mot de passe est incorrect.']);
        }
    
        // Mise à jour du mot de passe
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        // Redirection avec succès
        $notification = array(
            'message' => 'Mot de passe mis à jour avec succès.',
            'alert-type' => 'success',
        );
    
        return redirect()->route('admin.dashboard')->with($notification);
    }
}
