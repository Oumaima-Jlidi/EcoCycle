<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

use App\Models\Categorie;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     $notifications = Notification::where('is_read', false)->get();
        $categories = Categorie::all();
        $produits = Produit::all();
        return view('Back.pages.produits.test', compact('produits', 'categories','notifications'));

        //return view('Back.pages.test', compact('produits'));
    }

    public function indexFront(Request $request)
    {
        $query = Produit::query();

        // Filter by category if provided
        if ($request->has('category_id') && $request->category_id) {
            $query->where('categorie_id', $request->category_id);
        }

        // Filter by max price if provided
        if ($request->has('max_price')) {
            $query->where('prix', '<=', $request->max_price);
        }

        // Fetch filtered products with pagination
        $produits = $query->paginate(6);

        // Fetch categories with product count
        $categories = Categorie::withCount('produits')->get();

        return view('Front.pages.shop.shop', compact('produits', 'categories'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|string',
            'prix' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie_id' => 'required|exists:categories,id',

        ]);

        // Assigne l'ID de l'utilisateur connecté
        $data['user_id'] = Auth::id();

        // Gestion de l'image (si présente)
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time() . '.' . $extension;
            $file->move(public_path('images'), $filename);
            $data['image'] = 'images/' . $filename; // Store relative path for database

        }

        // Créer un nouveau produit
        Produit::create($data);

        // Rediriger avec un message de succès
        return redirect()->route('produit.index')->with('success', 'Produit ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the product by its ID
        $produit = Produit::findOrFail($id);

        // Return a view with the product details
        return view('Front.pages.shop.shop-detail', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id); // Trouver le produit par son ID
        return view('Back.pages.editProduit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'quantite' => 'required|string',
            'prix' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour l'image
            'categorie_id' => 'required|exists:categories,id',

        ]);

        // Trouver le produit par son ID
        $produit = Produit::findOrFail($id);

        // Gestion de l'image (si une nouvelle image est présente)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($produit->image) {
                $oldImagePath = public_path($produit->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Supprimer l'ancienne image
                }
            }

            // Traitement de la nouvelle image
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('images'), $filename);
            $data['image'] = 'images/' . $filename; // Store relative path for database
        } else {
            // Si aucune nouvelle image n'est fournie, conserver l'ancienne
            $data['image'] = $produit->image;
        }

        // Mettre à jour le produit
        $produit->update($data);

        // Rediriger avec un message de succès
        return redirect()->route('produit.index')->with('success', 'Produit mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id); // Trouver le produit par son ID
        $produit->delete(); // Supprimer le produit

        return redirect()->route('produit.index')->with('success', 'Produit supprimé avec succès');
    }
}
