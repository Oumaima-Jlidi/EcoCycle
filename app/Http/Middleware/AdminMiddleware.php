<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié et s'il a le rôle d'administrateur
        if (Auth::check() && Auth::user()->role_id === 1) { // Remplacez 1 par l'ID de votre rôle administrateur
            return $next($request); // Permettre l'accès à la route
        }

        // Si ce n'est pas un administrateur, rediriger vers la page d'accueil
        return redirect(RouteServiceProvider::HOME);
    }
}
