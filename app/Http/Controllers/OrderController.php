<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\User; 


class OrderController extends Controller
{
    


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
    $ordersCount = Commande::count();   
    $approvedOrders = Commande::where('statut', 'approuvé')->get();  
    $totalSales = $approvedOrders->sum('montant_total');   
    $usersCount = User::count();
    
    return view('Back.pages.index', [
        'ordersCount' => $ordersCount,
        'totalSales' => $totalSales,
        'usersCount' => $usersCount,
    ]);
}


 
    public function getCommande($id)
    {
        $commande = Commande::find($id);
        if ($commande) {
            return response()->json($commande);
        } else {
            return response()->json(['message' => 'Commande not found'], 404);
        }
    }

  
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
        $commande->statut = $request->statut ?? 'en cours';  
        $commande->date_commande = $request->date_commande;
        $commande->adresse_livraison = $request->adresse_livraison;
        $commande->save();

        return response()->json(['message' => 'Commande created successfully', 'commande' => $commande], 201);
    }

     
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

     
    public function destroy($id)
    {
         $commande = Commande::find($id);
    
         if (!$commande) {
            return redirect()->route('order.index')->with('error', 'Commande not found.');
        }
    
         $commande->delete();
    
         return redirect()->route('order.index')->with('success', 'Commande deleted successfully.');
    }
    
}
