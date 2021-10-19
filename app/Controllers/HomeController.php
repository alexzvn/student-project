<?php

namespace App\Controllers;

use App\Models\Product;
use Core\Http\Request;

class HomeController
{
    public function index()
    {
        return view('index', [
            'products' => Product::all()
        ]);
    }

    public function search(Request $request)
    {
        $keywords = Product::fuzzyText($request->query);

        $products = Product::sql(
            "SELECT * FROM :table WHERE MATCH(name,kind,brand) AGAINST($keywords IN BOOLEAN MODE)", Product::FETCH_MANY
        );

        return view('search', compact('products'));
    }
}
