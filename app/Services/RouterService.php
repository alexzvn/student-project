<?php

namespace App\Services;

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\HomeController;
use Core\Route;
use Core\Services\RouterService as CoreRouterService;

class RouterService extends CoreRouterService
{
    public function registerRoutes(Route $route)
    {
        $route->get('/', [HomeController::class, 'index']);

        $route->get('/login', [LoginController::class, 'index']);
        $route->post('/login', [LoginController::class, 'login']);
        $route->get('/register', [RegisterController::class, 'index']);
        $route->post('/register', [RegisterController::class, 'register']);
        $route->get('/logout', [LoginController::class, 'logout']);
    }
}
