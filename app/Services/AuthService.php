<?php

namespace App\Services;

use App\Models\User;
use Core\Http\Auth;
use Core\Http\Session;
use Core\Service;

class AuthService extends Service
{
    public function register()
    {
        $this->container->singleton(Auth::class);
    }

    public function boot(Session $session, Auth $auth)
    {
        if ($user = $session->get('auth:user')) {
            $auth->login(User::find($user));
        }

        $auth->onLogin(function (User $user) use ($session) {
            $session->put('auth:user', $user->id);
        });

        $auth->onLogout(function () use ($session) {
            $session->forget('auth:user');
        });
    }
}
