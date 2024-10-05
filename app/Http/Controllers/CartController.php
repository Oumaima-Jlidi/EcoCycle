<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('Front.pages.order.cart');
    }

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
        // Validate the quantity input
        $request->validate([
            'quantity' => 'required|integer|min:1', // Ensure quantity is a positive integer
        ]);
    
        // Retrieve the current cart from the session
        $cart = session()->get('cart', []);
    
        // Check if the product exists in the cart
        if (isset($cart[$id])) {
            // Update the quantity and calculate the total price based on the price per item
            $cart[$id]['quantity'] = $request->quantity; // Set the new quantity
            $cart[$id]['total_price'] = $cart[$id]['quantity'] * $cart[$id]['prix']; // Recalculate total price
    
            // Save the updated cart back to the session
            session()->put('cart', $cart);
        }
    
        // Return the updated cart and a success message
        return response()->json([
            'message' => 'Quantity updated successfully',
            'cart' => $cart,
        ]);
    }
    
    
}
