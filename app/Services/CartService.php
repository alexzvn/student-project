<?php

namespace App\Services;

use App\Support\Cart;
use Core\Http\View;
use Core\Service;

class CartService extends Service
{
    public function register()
    {
        $this->container->singleton(Cart::class);
    }

    public function boot(Cart $cart)
    {
        View::share('cart', $cart);
    }
}
