<?php

namespace Core\Services;

use Core\Route;
use Core\Container;
use Core\Http\Response;
use Core\Service;

abstract class RouterService extends Service
{
    protected Route $route;

    public function register(Route $route)
    {
        $this->route = $route;
    }

    abstract function registerRoutes(Route $route);

    public function boot()
    {
        $this->registerRoutes($this->route);

        Response::send($this->getDestination() ?? 'n/a');
    }

    protected function getDestination()
    {
        $this->route->prepare();

        if ($this->route->isAvailable() === false) {
            return null;
        }

        $handler = $this->route->getHandler();

        return is_array($handler)
            ? $this->resolveAbstract(...$handler)
            : $this->resolveValue($handler);
    }

    protected function resolveAbstract(string $controller, string $method)
    {
        $controller = $this->container->make($controller);

        return $controller->$method(
            ...Container::resolveMethod($controller, $method, $this->route->getParams())
        );
    }

    protected function resolveValue($any)
    {
        if (is_callable($any)) {
            return value($any);
        }

        return $any;
    }
}
