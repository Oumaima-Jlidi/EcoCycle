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
        $ordersCount = Commande::count();
        return view('Back.pages.commandes.listCommande')->with(['orders' => $orders, 'ordersCount' => $ordersCount]);
    }

   public function orderCount(){
    $ordersCount = Commande::count();  
    return view('Back.pages.index')->with('ordersCount', $ordersCount);  
}
public function dashboard()
{
    $ordersCount = Commande::count();  // Count total orders
    $approvedOrders = Commande::where('statut', 'approuvé')->get();  // Get approved orders
    $totalSales = $approvedOrders->sum('montant_total');  // Calculate total sales

    // Return the view with all necessary data
    return view('Back.pages.index', [
        'ordersCount' => $ordersCount,
        'totalSales' => $totalSales,
    ]);
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
    public function update(Request $request, $id)
    {
        $commande = Commande::find($id);
        if (!$commande) {
            return response()->json(['message' => 'Commande not found'], 404);
        }

        $request->validate([
           
            'statut' => 'string',
          
        ]);

         $commande->statut = $request->statut ?? $commande->statut;
         $commande->save();
         
 
         return redirect()->route('order.index');
   
        
        }

    // Delete a commande
    public function destroy($id)
    {
        // Find the commande by ID
        $commande = Commande::find($id);
    
        // Check if the commande exists
        if (!$commande) {
            return redirect()->route('order.index')->with('error', 'Commande not found.');
        }
    
        // Delete the commande
        $commande->delete();
    
        // Retrieve all remaining commandes
        return redirect()->route('order.index')->with('success', 'Commande deleted successfully.');
    }
    
}
