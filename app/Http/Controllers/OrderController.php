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
            // If the product is already in the cart, update the quantity and total price
            $cart[$product->id]['quantity'] += $request->quantity; // Change 'quantite' to 'quantity'
            $cart[$product->id]['total_price'] = $cart[$product->id]['quantity'] * $product->prix;
        } else {
            // If the product is not in the cart, add it
            $cart[$product->id] = [
                "id" => $product->id, 
                "name" => $product->nom,
                "quantity" => $request->quantity, // Change 'quantite' to 'quantity'
                "prix" => $product->prix,
                "total_price" => $product->prix * $request->quantity, // Change 'quantite' to 'quantity'
                "image" => $product->image, 
            ];
        }
    
        session()->put('cart', $cart);
    
        return response()->json([
            'message' => 'Product added to cart successfully', 
            'cart' => $cart,
            'redirect' => false   
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'adresse_livraison' => 'required|string|max:255',
        ]);
    
        $cart = session('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty. Please add items to your cart before proceeding to checkout.');
        }
    
        
        $subtotal = 0;
    
       
        $productIds = [];
        foreach ($cart as $item) {
            $subtotal += $item['total_price'] ?? 0;  
            $productIds[] = $item['id'];  
        }
    
        $orderData = [
            'montant_total' => $subtotal,  
            'statut' => 'en cours',  
            'date_commande' => now(), 
            'adresse_livraison' => $validatedData['adresse_livraison'],  
            'produits' => json_encode($productIds),   
            'user_id' => auth()->id(),  
        ];
    
        Commande::create($orderData);  
    
        session()->forget('cart');
    
        return redirect()->route('produits.indexFront')->with('success', 'Your order has been placed successfully!');
    }
    
    
    
}
