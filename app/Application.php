<?php

namespace App;

use App\Controllers\HomeController;
use Auth;
use Core\Container;
use Core\Http\Response;
use Core\Route;
use Session;

class Application
{
    protected Container $container;

    public function __construct() {
        $this->container = new Container;

        $this->registerService();
    }

    public function registerService()
    {
        $this->container->singleton(Session::class);
        $this->container->singleton(Auth::class);
        $this->container->singleton(Route::class);
    }

    public function handle()
    {
        $response = $this->container->make(Router::class)->getDestination();

        Response::send($response ?? '');
    }
}
