<?php

namespace App\Controllers;

use Core\Http\Request;
use Core\Http\Response;

class HomeController 
{
    public function index(Request $request)
    {
        return view('index');
    }
}
