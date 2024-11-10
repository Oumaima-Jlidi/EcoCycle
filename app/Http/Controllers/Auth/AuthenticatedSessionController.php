<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('Front.pages.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();
    
        // Vérifiez si l'utilisateur est actif
        if (!Auth::user()->is_active) {
            // Déconnecter l'utilisateur
            Auth::logout();
    
            // Regénérer le token de session
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            // Rediriger avec un message d'erreur
            return redirect('/login')->withErrors(['account' => 'Votre compte est désactivé. Veuillez contacter l\'administrateur.']);
        }
    
        $request->session()->regenerate();
    
        // Vérifier le rôle de l'utilisateur et rediriger en conséquence
        if (Auth::user()->role_id === 1) { // Remplacez 1 par l'ID de votre rôle administrateur
            return redirect(RouteServiceProvider::ADMIN);
        }
    
        return redirect(RouteServiceProvider::HOME);
    }
    

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
