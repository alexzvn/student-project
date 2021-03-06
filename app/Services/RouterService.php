<?php

namespace App\Services;

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\CartController;
use App\Controllers\HomeController;
use App\Controllers\Manager\OrderController;
use App\Controllers\Manager\ProductController;
use App\Controllers\UserController;
use Core\Http\Auth;
use Core\Http\Response;
use Core\Route;
use Core\Services\RouterService as CoreRouterService;

class RouterService extends CoreRouterService
{
    public function registerRoutes(Route $route)
    {
        $route->get('/', [HomeController::class, 'index']);
        $route->get('/search', [HomeController::class, 'search']);

        $route->get('/login', [LoginController::class, 'index']);
        $route->post('/login', [LoginController::class, 'login']);
        $route->get('/register', [RegisterController::class, 'index']);
        $route->post('/register', [RegisterController::class, 'register']);

        $route->get('/cart', [CartController::class, 'index']);
        $route->get('/cart/{product}/remove', [CartController::class, 'remove']);
        $route->get('/products/{product}/add', [CartController::class, 'add']);
        $route->post('/cart/checkout', [CartController::class, 'checkout']);
        $route->get('/cart/complete', [CartController::class, 'complete']);

        $this->registerPrivateRoutes($route, auth());
    }

    protected function registerPrivateRoutes(Route $route, Auth $auth)
    {
        if ($auth->isLogged() === false) return;
        $route->get('/logout', [UserController::class, 'logout']);
        $route->get('/me', [UserController::class, 'index']);
        $route->get('/me/orders', [UserController::class, 'order']);

        if (! $auth->user()->is_admin) return;
        $route->get('/manager/products', [ProductController::class, 'index']);
        $route->get('/manager/products/create', [ProductController::class, 'create']);
        $route->post('/manager/products/store', [ProductController::class, 'store']);
        $route->get('/manager/products/{id}', [ProductController::class, 'show']);
        $route->post('/manager/products/{id}/update', [ProductController::class, 'update']);
        $route->get('/manager/products/{id}/delete', [ProductController::class, 'delete']);

        $route->get('/manager/orders', [OrderController::class, 'index']);
        $route->get('/manager/orders/{id}', [OrderController::class, 'show']);
        $route->get('/manager/orders/{id}/delete', [OrderController::class, 'delete']);
    }

    public function getDestination()
    {
        return parent::getDestination() ?? view('errors.404')->code(404);
    }
}
