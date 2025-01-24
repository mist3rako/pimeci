<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthorized
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        switch ($user->role_as) {
            case 'super_admin':
            case 'admin_dci':
            case 'admin_dcri':
            case 'admin_dcqpc':
                return redirect()->route('admin.dashboard');
            case 'analyste':
                return redirect()->route('analyste.dashboard');
            case 'inspecteur_dci':
            case 'inspecteur_dcri':
            case 'inspecteur_dcqpc':
                return redirect()->route('inspecteur.dashboard');
            default:
                abort(403, 'Accès non autorisé');
        }

        return $next($request);
    }
}
