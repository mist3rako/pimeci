<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Initializing the redirect URL based on the user role
        $url = '';
        switch ($request->user()->role_as) {
            case 'admin_dci':
            case 'admin_dcri':
            case 'admin_dcqpc':
            case 'super_admin':
                $url = 'admin/dashboard';
                break;
        
            case 'inspecteur_dci':
            case 'inspecteur_dcri':
            case 'inspecteur_dcqpc':
                $url = 'inspecteur/dashboard';
                break;
        
            case 'analyste':
                $url = 'analyste/dashboard';
                break;
        
            default:
                $url = '/dashboard';
                break;
        }
        
        

        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
