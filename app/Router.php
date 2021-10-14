<?php

namespace App;

use App\Controllers\HomeController;
use Core\Route;
use Core\Container;

class Router
{
    protected $route;

    public function __construct(Route $route) {
        $this->route = $route;

        $this->registerRoutes();
    }

    public function registerRoutes()
    {
        $this->route->get('/', [HomeController::class, 'index']);
    }

    public function getDestination()
    {
        $this->route->prepare();

        if ($this->route->isAvailable() === false) {
            return null;
        }

        $handler = $this->route->getHandler();

        if (is_array($handler)) {
            [$class, $method] = $handler;
            $class = Container::make($class);

            return $class->$method(
                ...$this->route->getParams(),
                ...Container::resolveMethod($class, $method)
            );
        }

        if (is_callable($handler)) {
            return value($handler);
        }

        return $handler;
    }
}
