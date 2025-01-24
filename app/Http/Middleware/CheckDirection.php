<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDirection
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $routeParams = $request->route()->parameters();

        // Vérifier si l'utilisateur est un super admin
        if ($user->role_as === 'super_admin') {
            return $next($request);
        }

        // Récupérer le paramètre de direction dans l'URL
        $direction = $routeParams['dir_type_insp'] ?? null;

        // Si l'utilisateur est un admin et la direction ne correspond pas, renvoyer une erreur
        if ($direction && $user->role_as !== $direction) {
            return redirect('admin/dashboard')->with('error', 'Accès refusé à cette direction.');
        }

        return $next($request);
    }
}
