<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collecte;
use App\Models\Dechet;


class DechetController extends Controller
{
    public function index()
    {
        $collectes = Collecte::all();
        $dechets = Dechet::with('collecte')->get(); // Fetch dechets with their related collecte
        return view('Back.pages.dechets.index', compact('dechets','collectes'));
    }

    public function create()
    {
        $collectes = Collecte::all(); // Fetch collectes to associate with the dechets
        return view('Back.pages.dechets.create', compact('collectes','collectes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_dechet' => 'required|string|max:255',
            'quantite' => 'required|numeric',
            'origine' => 'nullable|string|max:255',
            'date_collecte' => 'required|date',
            'statut' => 'required|string|max:255',
            'collecte_id' => 'required|exists:collectes,id'
        ]);

        Dechet::create($validated);
        return redirect()->route('dechets.index')->with('success', 'Déchet ajouté avec succès.');
    }

    public function edit(Dechet $dechet)
    {
        $collectes = Collecte::all();
        return view('Back.pages.dechets.edit', compact('dechet', 'collectes'));
    }

    public function update(Request $request, Dechet $dechet)
    {
        $validated = $request->validate([
            'type_dechet' => 'required|string|max:255',
            'quantite' => 'required|numeric',
            'origine' => 'nullable|string|max:255',
            'date_collecte' => 'required|date',
            'statut' => 'required|string|max:255',
            'collecte_id' => 'required|exists:collectes,id'
        ]);

        $dechet->update($validated);
        return redirect()->route('dechets.index')->with('success', 'Déchet mis à jour avec succès.');
    }

    public function destroy(Dechet $dechet)
    {
        $dechet->delete();
        return redirect()->route('dechets.index')->with('success', 'Déchet supprimé avec succès.');
    }
}