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
        // Validation des champs du formulaire
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Récupération de l'utilisateur connecté
        $user = Auth::user();
        if (!$user) {
            return back()->withErrors(['user' => 'Utilisateur non connecté.']);
        }

        
        // Vérification du mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirection avec message de succès
        return redirect()->route('profile.show', $user->id)->with('success', 'Mot de passe mis à jour avec succès.');
    }
}