<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|array  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Convertir la chaîne de rôles en tableau si nécessaire
        $roles = is_array($role) ? $role : explode('|', $role);

        // Vérifier si l'utilisateur a l'un des rôles requis
        if (Auth::check() && !in_array(Auth::user()->role_as, $roles)) {
            // Renvoyer une réponse 403 si l'utilisateur n'a pas le rôle requis
            return abort(403, "Vous n'avez pas les autorisations nécessaires pour accéder à cette page.");
        }

        // Poursuivre l'exécution de la requête si l'utilisateur a le rôle requis
        return $next($request);
    }
}
