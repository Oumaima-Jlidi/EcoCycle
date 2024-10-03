<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Afficher le formulaire pour changer le mot de passe
     */
    public function changePassword()
    {
        return view('Front.pages.profileuser.change-password');
    }

    /**
     * Mettre à jour le mot de passe de l'utilisateur
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->withErrors('Vous devez être connecté pour changer votre mot de passe.');
    }
        // Validation des champs de formulaire
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérification du mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect.',
            ]);
        }

        // Si le nouveau mot de passe est identique à l'ancien mot de passe
        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors([
                'new_password' => 'Le nouveau mot de passe ne peut pas être identique à l\'ancien mot de passe.',
            ]);
        }

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->route('profile.show', $user->id)->with('success', 'Mot de passe changé avec succès.');
    }
}
