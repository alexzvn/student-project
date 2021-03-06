<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Http\Auth;
use Core\Http\Request;
use Core\Http\Response;
use Core\Support\Hash;

class RegisterController
{
    public function index(Response $response, Auth $auth)
    {
        if ($auth->isLogged()) {
            return $response->redirect('/');
        }

        return $response->view('auth.register');
    }

    public function register(Response $response, Auth $auth, Request $request)
    {
        if ($errors = $this->validate($request)) {
            session()->flash('errors', $errors);

            return $response->redirect($request->referer());
        }

        $user = new User();

        $user->fill($request->all())->forceFill([
            'password' => Hash::make($request->password),
            'is_admin' => 0
        ])->save();

        $auth->login($user);

        return $response->redirect('/');
    }

    public function validate(Request $request)
    {
        $errors = [];

        if (strlen($request->name) < 2) {
            $errors['name'] = 'Name too short';
        }

        if (! filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address';
        }

        if ($request->password !== $request->confirmed_password) {
            $errors['password'] = 'Password confirmed mismatch';
        }

        if (strlen($request->password) < 8) {
            $errors['password'] = 'Password at least 8 character';
        }

        if (empty($errors['email']) && User::findBy("email", $request->email)) {
            $errors['email'] = 'Email already registered';
        }

        return $errors;
    }
}
