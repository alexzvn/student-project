<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Http\Auth;
use Core\Http\Request;
use Core\Http\Response;

class LoginController
{
    public function index(Auth $auth, Response $response)
    {
        if ($auth->isLogged()) {
            return $response->redirect('/');
        }

        return $response->view('auth.login');
    }

    public function login(Request $request, Auth $auth, Response $response)
    {
        if ($auth->isLogged() || empty($request->email)) {
            return $response->redirect('/');
        }

        $user = User::retrieveByField('email', $request->email, User::FETCH_ONE);

        if ($errors = $this->validate($request, $user)) {
            session()->flash('errors', $errors);

            return $response->redirect($request->referer());
        }

        $auth->login($user);

        return $response->redirect('/');
    }

    public function validate(Request $request, User $user = null)
    {
        
    }
}

