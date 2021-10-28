<?php

namespace App\Controllers\Manager;

use App\Models\Order;

class OrderController
{
    public function index()
    {
        return view('manager.order.index', [
            'orders' => Order::sql("SELECT * FROM :table ORDER BY :pk DESC", Order::FETCH_MANY)
        ]);
    }

    public function show($id)
    {
        if (!$order = Order::find((int) $id)) {
            return;
        }

        return view('manager.order.view', [
            'order' => $order
        ]);
    }

    public function delete($id)
    {
        if ($order = Order::find($id)) {
            $order->delete();
            session()->flash('alert:success', "Deleted order #$order->id");
        }

        return redirect('/manager/products');
    }
}
