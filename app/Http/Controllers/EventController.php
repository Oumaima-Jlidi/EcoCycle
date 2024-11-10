<?php

namespace App\Http\Controllers;

use App\Models\Event; // Assurez-vous d'importer également le modèle Event
use App\Models\Feedback; // Importez le modèle Feedbackuse Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display the list of events in the back-end
    public function index()
    {
        $events = Event::all();
        return view('Back.pages.Events.ListeEvents')->with('events', $events);
    }

public function show(Request $request, $id)
{
    $event = Event::findOrFail($id);
    $averageRating = $event->feedbacks()->avg('rating');

    // Gestion de la mise à jour d'un feedback
    if ($request->isMethod('post')) {
        if ($request->has('delete_feedback_id')) {
            // Suppression d'un feedback
            $feedback = Feedback::findOrFail($request->delete_feedback_id);
            $feedback->delete();
            return redirect()->route('events.show', $event->id)->with('success', 'Feedback supprimé avec succès!');
        }

        if ($request->has('feedback_id')) {
            // Mise à jour d'un feedback
            $feedback = Feedback::findOrFail($request->feedback_id);
            $feedback->comment = $request->comment;
            $feedback->rating = $request->rating;
            $feedback->save();
            return redirect()->route('events.show', $event->id)->with('success', 'Feedback mis à jour avec succès!');
        }
    }

    $feedbacks = $event->feedbacks()->where('status', 1)->get();

    return view('Front.pages.event.details', compact('event','averageRating'));
}


    public function store(Request $request)
    {
        try {
            // Validate the form data
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'start_date' => 'required|date|before_or_equal:end_date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'location' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'max_participants' => 'required|integer',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
            ]);
    
            $data['user_id'] = Auth::id();

            // Handle image upload if present
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('events', 'public'); // Store the image
            }
    
            // Create a new event
            Event::create($data);
    
            // Redirect with a success message
            return redirect()->route('events.index')->with('success', 'Événement ajouté avec succès');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur s\'est produite : ' . $e->getMessage())
                ->withInput();
        }
    }
    
    // Display events on the front-end
    public function indexFront(Request $request)
    {
        $sortOrder = $request->input('sort', 'desc');
        $today = Carbon::now();
        $events = Event::where('start_date', '>', $today->subDays(15))
        ->orderBy('start_date', $sortOrder)
        ->paginate(6);
        $upcomingEvents = Event::where('start_date', '>', $today)
        ->where('start_date', '<=', $today->addDays(7))
        ->orderBy('start_date', 'asc')
        ->get();       
        return view('Front.pages.event.index', [
            'events' => $events,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }

    // Display the event creation form on the front-end
    public function createFront()
    {
        return view('Front.pages.event.create');
    }

    public function storefront(Request $request)
{
    try {
        // Validate the form data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'max_participants' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation
        ]);
        $data['user_id'] = Auth::id();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public'); // Store the image
        }

        // Create a new event
        Event::create($data);

        // Redirect with a success message
        return redirect()->route('events.indexFront')->with('success', 'Événement ajouté avec succès');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput();
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Une erreur s\'est produite : ' . $e->getMessage())
            ->withInput();
    }
}



    // Delete an event
    public function destroy($id)
    {
        $event = Event::findOrFail($id); // Find the event by ID
        $event->delete(); // Delete the event

        return redirect()->route('event.index')->with('success', 'Événement supprimé avec succès');
    }

    public function destroyFront($id)
    {
        $event = Event::findOrFail($id); // Find the event by ID
        $event->delete(); // Delete the event

        return redirect()->route('events.indexFront')->with('success', 'Événement supprimé avec succès');
    }

    // Show the edit form for an event
    public function edit($id)
    {
        $event = Event::findOrFail($id); // Find the event by ID
        return view('Back.pages.editEvent', compact('event'));
    }

    // Update an event
    public function update(Request $request, $id)
    {
        // Validate the form data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'max_participants' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        // Find the event by ID
        $event = Event::findOrFail($id);
        
        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($event->image) {
                \Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public'); // Store new image
        }
        
        // Update the event
        $event->update($data);

        // Redirect with a success message
        return redirect()->route('event.index')->with('success', 'L’événement a été mis à jour avec succès.');
    }



    public function editFront($id)
    {
        $event = Event::findOrFail($id);
        return view('Front.pages.event.edit', compact('event'));
    }

    public function updatefront(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'max_participants' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->location = $request->location;
        $event->max_participants = $request->max_participants;

        // Vérifiez si une nouvelle image a été téléchargée
        if ($request->hasFile('image')) {
            // Supprimez l'ancienne image si elle existe
            if ($event->image) {
                Storage::delete($event->image);
            }
            // Enregistrez la nouvelle image
            $event->image = $request->file('image')->store('events');
        }

        $event->save();

        return redirect()->route('events.indexFront')->with('success', 'L\'événement a été mis à jour avec succès.');
    }


    // Store feedback for an event
    public function storeFeedback(Request $request, Event $event)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'nullable|integer|between:1,5',
        ]);

        $event->feedbacks()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Commentaire soumis avec succès!');
    }

    public function exportPdf($id)
{
    // Récupérer l'événement et l'inscription de l'utilisateur
    $event = Event::findOrFail($id);
    $user = Auth::user();
    $registration = $event->registrations()->where('user_id', $user->id)->first();

    // Vérifier si l'utilisateur est inscrit à cet événement
    if (!$registration) {
        return redirect()->back()->with('error', 'Vous n\'êtes pas inscrit à cet événement.');
    }

    // Créer une vue dédiée pour le PDF (explique cela ci-dessous)
    $pdf = PDF::loadView('Front.pages.event.registration-ppdf', compact('event', 'user', 'registration'));

    // Télécharger le PDF avec un nom de fichier
    return $pdf->download('inscription_event_' . $event->title . '.pdf');
}

public function search(Request $request)
{
    $query = Event::query();

    if ($request->filled('date')) {
        $query->whereDate('start_date', $request->input('date'));
    }

    if ($request->filled('event')) {
        $query->where('title', 'like', '%' . $request->input('event') . '%');
    }

    if ($request->filled('location')) {
        $query->where('location', 'like', '%' . $request->input('location') . '%');
    }

    $events = $query->get();

    return response()->json($events);
}
}
