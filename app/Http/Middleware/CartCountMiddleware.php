<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CartCountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = session()->get('cart', []);
        $cartCount = 0;

        foreach ($cart as $item) {
            $cartCount += $item['quantity'] ?? 0;
        }

        view()->share('cartCount', $cartCount);

        return $next($request);
    }
}
