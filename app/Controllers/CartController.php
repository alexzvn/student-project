<?php

namespace App\Controllers;

use App\Models\Product;
use App\Support\Cart;
use Core\Http\Auth;
use Core\Http\Request;

class CartController
{
    public function index(Cart $cart)
    {
        return view('cart', [
            'items' => $cart->items()
        ]);
    }

    public function add($id, Cart $cart)
    {
        if (Product::find($id)) {
            $cart->add($id);

            session()->flash('alert:success', 'Added one item to cart');
        }

        return back();
    }

    public function remove($id, Cart $cart)
    {
        if ($cart->has($id)) {
            $cart->remove($id);

            session()->flash('alert:success', 'Item removed');
        }

        return back();
    }

    public function checkout(Request $request, Cart $cart, Auth $auth)
    {
        foreach ($request->post('item') as $id => $amount) {
            $cart->set($id, (int) $amount);
        }

        if ($auth->isLogged() === false) {
            session()->flash('alert:error', 'You need login before checkout');

            return redirect('/login');
        }

        if ($cart->isEmpty()) {
            session()->flash('alert:error', 'Can\'t checkout due cart is empty.');

            return back();
        }
    }
}
