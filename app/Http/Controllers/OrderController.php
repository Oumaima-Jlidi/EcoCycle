<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Get all commandes
    public function index()
    {
        $orders = Commande::all();
        return view('Back.pages.commandes.listCommande', compact('orders'));
    }

    // Get a single commande by ID
    public function getCommande($id)
    {
        $commande = Commande::find($id);
        if ($commande) {
            return response()->json($commande);
        } else {
            return response()->json(['message' => 'Commande not found'], 404);
        }
    }

    // Create a new commande
    public function createCommande(Request $request)
    {
        $request->validate([
            'montant_total' => 'required|numeric',
            'statut' => 'string',
            'date_commande' => 'required|date',
            'adresse_livraison' => 'required|string',
        ]);

        $commande = new Commande();
        $commande->montant_total = $request->montant_total;
        $commande->statut = $request->statut ?? 'en cours'; // Default value
        $commande->date_commande = $request->date_commande;
        $commande->adresse_livraison = $request->adresse_livraison;
        $commande->save();

        return response()->json(['message' => 'Commande created successfully', 'commande' => $commande], 201);
    }

    // Update an existing commande
    public function updateCommande(Request $request, $id)
    {
        $commande = Commande::find($id);
        if (!$commande) {
            return response()->json(['message' => 'Commande not found'], 404);
        }

        $request->validate([
            'montant_total' => 'numeric',
            'statut' => 'string',
            'date_commande' => 'date',
            'adresse_livraison' => 'string',
        ]);

        $commande->montant_total = $request->montant_total ?? $commande->montant_total;
        $commande->statut = $request->statut ?? $commande->statut;
        $commande->date_commande = $request->date_commande ?? $commande->date_commande;
        $commande->adresse_livraison = $request->adresse_livraison ?? $commande->adresse_livraison;
        $commande->save();

        return response()->json(['message' => 'Commande updated successfully', 'commande' => $commande]);
    }

    // Delete a commande
    public function deleteCommande($id)
    {
        $commande = Commande::find($id);
        if (!$commande) {
            return response()->json(['message' => 'Commande not found'], 404);
        }

        $commande->delete();
        return response()->json(['message' => 'Commande deleted successfully']);
    }
}
