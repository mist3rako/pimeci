<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    // Affiche le formulaire pour demander la réinitialisation du mot de passe
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password'); // Assurez-vous que ce chemin correspond à votre vue
    }

    // Envoie le lien de réinitialisation du mot de passe
    public function sendResetLinkEmail(Request $request)
    {
        // Validation de l'email
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Envoi du lien de réinitialisation
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Vérification du statut de l'envoi
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        }

        return back()->withErrors(['email' => __($status)]);
    }

    // Méthode de test pour envoyer un email
    public function testEmail()
    {
        Mail::raw('Ceci est un test', function ($message) {
            $message->to('mist3rako@gmail.com') // Remplacez par votre adresse email pour le test
                    ->subject('Test Email');
        });
    
        return 'Email envoyé!';
    }
    
}
