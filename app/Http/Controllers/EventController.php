<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        return view('Back.pages.Events.ListeEvents')->with('events', $events);

        //return view('Back.pages.test', compact('produits'));
    }
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'required',
            'max_participants' => 'required|integer',
        ]);
    
        // Créer un nouvel événement
        Event::create($data);
    
        // Rediriger avec un message de succès
        return redirect()->route('event.index')->with('success', 'Événement ajouté avec succès');
    }
    public function destroy($id)
    {
        $event = Event::findOrFail($id); // Trouver le produit par son ID
        $event->delete(); // Supprimer le produit

        return redirect()->route('event.index')->with('success', 'event supprimé avec succès');
    }    

    public function edit($id)
    {
        $event = Event::findOrFail($id); // Trouver le produit par son ID
        return view('Back.pages.editEvent', compact('event'));
    }
    public function update(Request $request, $id)
{
    // Valider les données du formulaire
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'start_date' => 'required|date|before_or_equal:end_date', // start_date doit être avant ou égale à end_date
        'end_date' => 'required|date|after_or_equal:start_date', // end_date doit être après ou égale à start_date
        'location' => 'required|string|max:255',
        'description' => 'required|string', // Ajout de string pour plus de précision
        'max_participants' => 'required|integer|min:1', // min:1 pour éviter un nombre de participants négatif
    ]);

    // Trouver l'événement par son ID
    $event = Event::findOrFail($id);
    
    // Mettre à jour l'événement
    $event->update($data);

    // Rediriger avec un message de succès
    return redirect()->route('event.index')->with('success', 'L’événement a été mis à jour avec succès.');
}

}
