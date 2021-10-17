<?php

namespace Core\Http;

class Auth
{
    protected $user;

    protected $events = [
        'login' => [],
        'logout' => []
    ];

    public function login($user)
    {
        $this->dispatch('login', $this->user = $user);
    }

    public function logout()
    {
        $this->dispatch('logout', $this->user);

        return $this->user = null;
    }

    public function isLogged()
    {
        return $this->user !== null;
    }

    public function onLogin(callable $callback)
    {
        $this->events['login'] = $callback;
    }

    public function onLogout(callable $callback)
    {
        $this->events['logout'] = $callback;
    }

    protected function dispatch(string $event, ...$args)
    {
        foreach ($this->events[$event] as $callback) {
            $callback(...$args);
        }
    }

    public function user()
    {
        return $this->user;
    }
}

