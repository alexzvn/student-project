<?php

namespace App\Controllers;

use App\Models\Product;
use Core\Http\Request;
use Core\Http\Response;

class HomeController
{
    public function index()
    {
        return view('index', [
            'products' => Product::all()
        ]);
    }
}
