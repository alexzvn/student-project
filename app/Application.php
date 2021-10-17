<?php

namespace App;

use Core\Container;
use Core\Contracts\ApplicationContract;

class Application implements ApplicationContract
{
    protected Container $container;

    /**
     * All Services
     *
     * @var mixed
     */
    protected array $services = [
        \Core\Services\SessionService::class,
        \Core\Services\DatabaseService::class,
        \App\Services\AuthService::class,
        \App\Services\RouterService::class,
    ];

    public function __construct() {
        $this->container = new Container;
        $this->container->bind(Container::class, $this->container);
    }

    /**
     * Prepare service
     *
     * @return void
     */
    protected function prepare()
    {
        $this->services = array_map(function ($service) {
            $service = $this->container->make($service);

            if (method_exists($service, 'register')) {
                $service->register(...$this->container->resolveMethod($service, 'register'));
            }

            return $service;
        }, $this->services);
    }

    protected function boot()
    {
        foreach ($this->services as $service) {
            if (method_exists($service, 'boot')) {
                $service->boot(...$this->container->resolveMethod($service, 'boot'));
            }
        }
    }

    public function handle()
    {
        $this->prepare();
        $this->boot();
    }

    public function container()
    {
        return $this->container;
    }
}
