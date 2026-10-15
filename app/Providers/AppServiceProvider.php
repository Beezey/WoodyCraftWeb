<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Nombre d'articles du panier, affiché dans l'en-tête de chaque page
        View::composer('layouts.navigation', function ($view) {
            $cart = Cart::current();

            $view->with('cartCount', $cart ? (int) $cart->items()->sum('quantity') : 0);
        });
    }
}
