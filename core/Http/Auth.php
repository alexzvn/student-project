<?php

namespace Core\Http;

class Auth
{
    protected $user;

    public function login($user)
    {
        $this->user = $user;
    }

    public function logout()
    {
        return $this->user = null;
    }

    public function isLogged()
    {
        return $this->user !== null;
    }

    public function user()
    {
        return $this->user;
    }
}

