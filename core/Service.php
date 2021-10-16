<?php

namespace Core;

use Core\Contracts\ApplicationContract;
use Core\Contracts\ServiceContract;

abstract class Service
{
    protected Container $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }
}
