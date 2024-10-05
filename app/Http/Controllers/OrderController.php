<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    


    public function index()
    {
        $orders = Commande::all();
        $ordersCount = Commande::count();
        return view('Back.pages.commandes.listCommande')->with(['orders' => $orders, 'ordersCount' => $ordersCount]);
    }

   public function orderCount()
   {
    $ordersCount = Commande::count();  
    return view('Back.pages.index')->with('ordersCount', $ordersCount);  
   }


   public function dashboard()
   {
    $ordersCount = Commande::count();   
    $approvedOrders = Commande::where('statut', 'approuvé')->get();  
    $totalSales = $approvedOrders->sum('montant_total');   

    
    return view('Back.pages.index', [
        'ordersCount' => $ordersCount,
        'totalSales' => $totalSales,
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
    


    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produits,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $product = Produit::find($request->product_id);
        $cart = session()->get('cart', []);
     
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantite'] += $request->quantity;
            $cart[$product->id]['total_price'] = $cart[$product->id]['quantite'] * $product->prix;
        } else {
            $cart[$product->id] = [
                "id" => $product->id, 
                "name" => $product->nom,
                "quantite" => $request->quantite,
                "prix" => $product->prix,
                "total_price" => $product->prix * $request->quantite,
                "image" => $product->image, 
            ];
        }
        
    
        // Save the updated cart back into the session
        session()->put('cart', $cart);
    
        return response()->json([
            'message' => 'Product added to cart successfully', 
            'cart' => $cart,
            'redirect' => false  // Set this to true if you want to redirect to the cart
        ]);
    }
    
    
    
}
