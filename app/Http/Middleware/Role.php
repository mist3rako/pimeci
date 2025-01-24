<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|array  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Gérer plusieurs rôles
        $roles = is_array($role) ? $role : explode('|', $role);

        // Vérifier si l'utilisateur a l'un des rôles requis
        if (!in_array($request->user()->role_as, $roles)) {
            return redirect('/dashboard');
        }

        // Rediriger tous les utilisateurs loin de /dashboard vers leur tableau de bord respectif
        if ($request->is('dashboard')) {
            switch ($request->user()->role_as) {
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
        }

        return $next($request);
    }
}
