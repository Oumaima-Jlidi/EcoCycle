<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collecte;

class CollecteController extends Controller
{

    public function index()
    {
        $collectes = Collecte::all();
        return view('Back.pages.collectes.index')->with('collectes', $collectes);
    }

    public function create()
    {
        return view('Back.pages.collectes.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'type_dechet' => 'required',
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
            'type_dechet' => 'required',
            'zone_collecte' => 'required|regex:/^[\pL\s]+$/u',
            'statut' => 'required',
            'date_collecte' => 'required|date',
            'quantite_collecte' => 'required|numeric|min:0',
        ]);

        // Mettre à jour la collecte
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
