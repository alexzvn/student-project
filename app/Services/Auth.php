<?php

class Auth
{
    protected $session;

    protected $user;

    public function __construct(Session $session) {
        $this->session = $session;
    }

    public function loggedIn()
    {
        return $this->user !== null;
    }
}
