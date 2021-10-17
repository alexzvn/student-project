<?php

namespace App\Controllers\Auth;

use Core\Http\Auth;
use Core\Http\Response;

class LogoutController
{
    public function logout(Auth $auth, Response $response)
    {
        if ($auth->isLogged()) {
            $auth->logout();
        }

        return $response->redirect('/');
    }
}
