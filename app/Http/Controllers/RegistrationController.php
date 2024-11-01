<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Mail\RegistrationConfirmation; // Import the confirmation mailable
use Illuminate\Support\Facades\Mail; // Import the Mail facade

class RegistrationController extends Controller
{
    public function register(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
    
        // Vérifiez si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour participer à l\'événement.');
        }
    
        // Vérifiez si l'utilisateur est déjà inscrit
        $registration = Registration::where('event_id', $eventId)
            ->where('user_id', Auth::id())
            ->first();
    
        if ($registration) {
            return redirect()->back()->with('info', 'Vous êtes déjà inscrit à cet événement.');
        }
    
        // Vérifiez s'il y a des places restantes
        if ($event->participants_count >= $event->max_participants) {
            return redirect()->back()->with('error', 'Aucune place restante pour cet événement.');
        }
    
        // Créez l'inscription
        $registration = Registration::create([
            'event_id' => $eventId,
            'user_id' => Auth::id(),
            'registration_date' => now(),
        ]);
    
        // Mettez à jour le nombre de participants
        $event->increment('participants_count');
    
        // Envoyer l'email de confirmation
        //Mail::to(Auth::user()->email)->send(new RegistrationConfirmation($event));
    
        return redirect()->back()->with('success', 'Inscription réussie pour l\'événement.');
    }
    
}