<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart.');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    public function showCart()
    {
        $cart = session('cart', []);
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['total_price'] ?? 0;
        }

        return view('Front.pages.order.cart', compact('cart', 'subtotal'));
    }
    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',  
        ]);
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            // Use the correct key
            $cart[$id]['quantite'] = $request->quantity;  
            $cart[$id]['total_price'] = $cart[$id]['quantite'] * $cart[$id]['prix'];  
    
            session()->put('cart', $cart);
        }
    
        return response()->json([
            'message' => 'Quantity updated successfully',
            'cart' => $cart,
        ]);
    }
    
    public function checkout()
    {
        // Get the cart items from the session
        $cart = session('cart', []);
        
        // If the cart is empty, redirect to the cart page with an error message
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty. Please add items to your cart before proceeding to checkout.');
        }
    
        // Calculate the total amount for the cart
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['total_price'] ?? 0; // Accumulate the total price of each item
        }
    
        // Optionally, you can pass any additional data needed for the checkout view
        return view('Front.pages.order.checkout', compact('cart', 'subtotal'));
    }
    
    
}
