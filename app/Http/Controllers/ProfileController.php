<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Mise à jour des champs nom, prénom et email
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');

        // Réinitialiser la vérification de l'email si l'email a été modifié
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Sauvegarde des modifications
        $user->save();

        // Redirection vers la page d'édition du profil avec un message de succès
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Suppression du compte utilisateur
        $user->delete();

        // Invalidation de la session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirection vers la page d'accueil après suppression
        return Redirect::to('/');
    }
}
