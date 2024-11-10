<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = 0;
            dd(session()->get('cart'));

            foreach ($cart as $item) {
                $cartCount += $item['quantity'] ?? 0;  
            }
    
            $view->with('cartCount', $cartCount);
        });
    }
}
