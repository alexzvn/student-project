<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Support\Cart;
use Core\Http\Auth;
use Core\Http\Request;
use Core\Http\Session;

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

    public function complete(Session $session)
    {
        if (!$order = $session->old('order:placed')) {
            return redirect('/');
        }

        return view('thankyou', [
            'order' => Order::find($order)
        ]);
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

        $order = new Order();

        $order->forceFill([
            'address' => $auth->user()->address,
            'user_id' => $auth->user()->id
        ])->save();

        $sql = [];
        foreach ($cart->items() as $item) {
            [$product, $amount] = $item;

            $sql[] = "($product->id, $order->id, $amount)";
        }

        Order::sql("INSERT INTO order_items (product_id, order_id, amount) VALUE " . implode(',', $sql), Order::FETCH_NONE);

        $cart->clear();

        session()->flash('order:placed', $order->id);

        return redirect('/cart/complete');
    }
}
