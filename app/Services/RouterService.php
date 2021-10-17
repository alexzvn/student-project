<?php

namespace App\Services;

use App\Controllers\HomeController;
use Core\Route;
use Core\Services\RouterService as CoreRouterService;

class RouterService extends CoreRouterService
{
    public function registerRoutes(Route $route)
    {
        $route->get('/', [HomeController::class, 'index']);
    }
}
