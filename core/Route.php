<?php

namespace Core;

class Route
{
    protected array $uri = [];

    protected $current = null;

    public function register(string $uri, string $method, $handler)
    {
        $uri = preg_replace('/{[a-zA-Z0-9_-]+}/', '([a-zA-Z0-9_-]+)', $uri);
        $uri = str_replace('/', '\\/', $uri);

        $this->uri[strtoupper($method)]["/^$uri$/"] = $handler;
    }

    public function post(string $uri, $handler)
    {
        $this->register($uri, 'POST', $handler);
    }

    public function get(string $uri, $handler)
    {
        $this->register($uri, 'GET', $handler);
    }

    /**
     * Check if there any route available for current request
     *
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->current !== null;
    }

    public function getHandler()
    {
        return $this->current[1] ?? null;
    }

    public function getParams()
    {
        preg_match($this->current[0], rtrim($this->getRequestURI(), '/'), $matches);

        array_shift($matches);

        return $matches;
    }

    /**
     * Get ready before handle request
     *
     * @return void
     */
    public function prepare()
    {
        $routes = $this->uri[$this->getMethod()] ?? [];

        foreach ($routes as $uri => $handler) {
            if (preg_match($uri, $this->getRequestURI())) {
                return $this->current = [$uri, $handler];
            }
        }
    }

    protected function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function getRequestURI()
    {
        $requestURI = strtok($_SERVER["REQUEST_URI"], '?');
        $requestURI = rtrim($requestURI, '/');
        $requestURI = $requestURI === '' ? '/' : $requestURI;

        return $requestURI;
    }
}
