<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\User;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('event', 'user')->get();
       
        return view('Back.pages.feedback.index', compact('feedbacks'));
    }

  

    public function create()
{
    $events = Event::all(); // Récupérer tous les événements
    $users = User::all();   // Récupérer tous les utilisateurs

    return view('feedback.index', compact('events', 'users'));
}
    // Stocker un nouveau feedback
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'nullable|integer|between:1,5',
        ]);
    
        // Créer le feedback associé à l'événement
        $feedback = $event->feedbacks()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
    
        // Rediriger vers la page de détails de l'événement en fournissant l'ID de l'événement
        return redirect()->route('events.show', $event->id)->with('success', 'Feedback soumis avec succès!');
    }
    

    // Afficher le formulaire d'édition d'un feedback
    public function edit(Feedback $feedback)
    {
        $feedback = Feedback::findOrFail($id); 
        return view('Back.pages.feedback.edit', compact('feedback'));
    }

    // Mettre à jour un feedback existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);
    
        $feedback = Feedback::findOrFail($id);
        $feedback->update($request->all());
    
        return redirect()->back()->with('success', 'Feedback mis à jour avec succès');
    }
    public function destroyF($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
    
        return redirect()->route('events.show', $feedback->event_id)->with('success', 'Feedback supprimé avec succès!');
    }

    // Supprimer un feedback
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedback.index')->with('success', 'Feedback supprimé avec succès!');
    }
    public function submitFeedback(Request $request, $eventId)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5', // rating entre 1 et 5
        ]);

        // Créer un feedback
        Feedback::create([
            'event_id' => $eventId,
            'user_id' => auth()->id(), // ID de l'utilisateur connecté
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('events.show', $eventId)->with('success', 'Feedback ajouté avec succès');
    }
}