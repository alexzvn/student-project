<?php

namespace App\Support;

use Core\Http\Session;

class Cart
{
    protected Session $session;

    protected array $cart = [];

    public function __construct(Session $session) {
        $this->session = $session;
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

    public function remove($id)
    {
        unset($this->cart[$id]);
    }

    public function get()
    {
        return $this->cart;
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
