<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collecte;
use App\Models\Notification;

class CollecteController extends Controller
{
    public function indexfront()
    { 
        $collectes = Collecte::all();
        return view('Front.pages.collect.index')->with(['collectes'=> $collectes]);

    }

    public function index()
    { $notifications = Notification::where('is_read', false)->get();
        $collectes = Collecte::all();
        return view('Back.pages.collectes.index')->with(['collectes'=> $collectes, 'notifications'=> $notifications]);
    }

    public function create()
    {
        return view('Back.pages.collectes.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'nom_collecte' => 'required',
            'zone_collecte' => 'required|regex:/^[\pL\s]+$/u',
            'statut' => 'required',
            'date_collecte' => 'required|date',
            'quantite_collecte' => 'required|numeric|min:0',
        ]);

        // Créer une nouvelle collecte
        Collecte::create($request->all());

        return redirect()->route('collectes.index')->with('success', 'Collecte ajoutée avec succès');
    }

    public function edit($id)
    {
        $collecte = Collecte::findOrFail($id);
        return view('Back.pages.collectes.edit', compact('collecte'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'nom_collecte' => 'required',
            'zone_collecte' => 'required|regex:/^[\pL\s]+$/u',
            'statut' => 'required',
            'date_collecte' => 'required|date',
            'quantite_collecte' => 'required|numeric|min:0',
        ]);

        
        $collecte = Collecte::findOrFail($id);
        $collecte->update($request->all());

        return redirect()->route('collectes.index')->with('success', 'Collecte mise à jour avec succès');
    }

    public function destroy($id)
    {
        $collecte = Collecte::findOrFail($id);
        $collecte->delete();

        return redirect()->route('collectes.index')->with('success', 'Collecte supprimée avec succès');
    }
}
