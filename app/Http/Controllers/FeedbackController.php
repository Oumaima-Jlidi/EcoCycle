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
    $events = Event::all();
    $users = User::all();   

    return view('feedback.index', compact('events', 'users'));
}
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'nullable|integer|between:1,5',
        ]);
    
        $feedback = $event->feedbacks()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
    
        return redirect()->route('events.show', $event->id)->with('success', 'Feedback soumis avec succès!');
    }
    

    public function edit(Feedback $feedback)
    {
        $feedback = Feedback::findOrFail($id); 
        return view('Back.pages.feedback.edit', compact('feedback'));
    }

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

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('feedback.index')->with('success', 'Feedback supprimé avec succès!');
    }
    public function submitFeedback(Request $request, $eventId)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5', 
        ]);

        Feedback::create([
            'event_id' => $eventId,
            'user_id' => auth()->id(), 
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('events.show', $eventId)->with('success', 'Feedback ajouté avec succès');
    }

    public function ActivateDesactivateStatus($id)
{
    $feedback = Feedback::findOrFail($id);
    $feedback->status = !$feedback->status; 
    $feedback->save();

    return redirect()->route('feedback.index')->with('success', 'Statut du feedback mis à jour avec succès.');
}


}