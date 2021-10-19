<?php

namespace App\Support;

use App\Models\Product;
use Core\Http\Session;
use Core\Support\Collection;

class Cart
{
    protected Session $session;

    protected array $cart = [];

    public function __construct(Session $session) {
        $this->session = $session;

        $this->load();
    }

    protected function load()
    {
        $this->cart = $this->session->get('app:cart', []);
    }

    protected function save()
    {
        $this->session->put('app:cart', $this->cart);
    }

    public function add($id)
    {
        $this->cart[$id] ??= 0;

        $this->cart[$id]++;
    }

    public function set($id, int $count)
    {
        $this->cart[$id] = $count;
    }

    public function remove($id)
    {
        unset($this->cart[$id]);
    }

    public function has($id)
    {
        return isset($this->cart[$id]);
    }

    public function isEmpty()
    {
        return empty($this->cart);
    }

    public function count()
    {
        return array_sum(array_values($this->cart));
    }

    public function get()
    {
        return $this->cart;
    }

    public function items()
    {
        if (empty($this->cart)) {
            return [];
        }

        $ids = implode(',', array_keys($this->cart));

        $products = new Collection(
            Product::sql("SELECT * FROM :table WHERE id IN ($ids)", Product::FETCH_MANY)
        );

        foreach ($products as $product) {
            $items[] = [$product, $this->cart["$product->id"]];
        }

        return $items ?? [];
    }

    public function clear()
    {
        $this->cart = [];
    }

    public function __destruct()
    {
        $this->save();
    }
}
