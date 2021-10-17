<?php

namespace Core\Services;

use Core\Service;
use Core\Http\Session;

class SessionService extends Service
{
    public function register()
    {
        $this->container->singleton(Session::class);
    }

    public function boot(Session $session)
    {
        $session->flash('inputs', $_POST);
    }
}
