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

    protected Route $route;

    public function __construct() {
        $this->container = new Container;
        $this->route = $this->container->make(Route::class);

        $this->boot();
    }

    protected function boot()
    {
        $this->registerRoutes();
        $this->registerService();
    }

    public function registerService()
    {
        $this->container->singleton(Session::class);
        $this->container->singleton(Auth::class);
    }

    public function registerRoutes()
    {
        $this->route->get('/', [HomeController::class, 'index']);
    }

    public function handle()
    {
        $this->route->build();

        if ($this->route->isAvailable() === false) {
            die('Page not found 404');
        }

        Response::send($this->buildResponse());
    }

    private function buildResponse()
    {
        $handler = $this->route->getHandler();

        if (is_array($handler)) {
            [$class, $method] = $handler;
            $class = $this->container->make($class);

            return $class->$method(
                ...$this->route->getParams(),
                ...$this->container->resolveMethod($class, $method)
            );
        }

        if (is_callable($handler)) {
            return value($handler);
        }

        return $handler;
    }
}
