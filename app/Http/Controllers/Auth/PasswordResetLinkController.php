<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(PasswordResetRequest $request)
    {
        // Find the user by email
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            // Generate a token
            $token = Password::createToken($user);
    
            // Save the token to the user's reset_token_insp field
            $user->reset_token_insp = $token; // Assurez-vous que cette colonne existe
            $user->save();
    
            // Send the password reset link
            $status = Password::sendResetLink(
                $request->only('email'),
                function ($message) {
                    $message->subject('Réinitialisation de votre mot de passe - MCI - Inspections');
                }
            );
    
            return $status === Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
        }
    
        return back()->withErrors(['email' => 'Email non trouvé.']);
    }
    
}
