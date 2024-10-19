<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{

    // affichage back office 
    public function index()
    {
        $categories = Categorie::withCount('produits')->get();
        return view('Back.pages.produits.list', compact('categories'));
    }

    // affichage front office 
    public function shop()
    {
        $categories = Categorie::withCount('produits')->get();
        return view('Front.pages.shop.shop', compact('categories'));
    }

    // create
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Categorie::create($data);
        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès');
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $categorie = Categorie::findOrFail($id);
        $categorie->nom = $request->nom;
        $categorie->description = $request->description;
        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }


    // delete
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès');
    }
}
