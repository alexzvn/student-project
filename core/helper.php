<?php

use Core\Container;
use Core\Contracts\ApplicationContract;
use Core\Http\Auth;
use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Session;
use Core\Http\View;
use Core\Support\Path;

/**
 * The e function runs PHP's htmlspecialchars function with the double_encode option set to true by default:
 *
 * @param mixed $content
 * @return string
 */
function e($content) {
    return htmlspecialchars($content);
}

/**
 * Get root path of project
 *
 * @return string
 */
function base_path(string $path = '')
{
    return Path::join(BASE_PATH, $path);
}

/**
 * Get root path of public
 *
 * @return string
 */
function public_path(string $path = '')
{
    return Path::join(base_path('public'), $path);
}

/**
 * Get value in callback
 *
 * @param callable $callback
 * @return mixed
 */
function value(callable $callback)
{
    return $callback();
}

/**
 * Get config value
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function config(string $key, $default = null)
{
    static $config;

    if ($config === null) {
        $config = require base_path('config.php');
    }

    return array_dot($key, $config, $default);
}

/**
 * Access array by dot
 *
 * @return mixed
 */
function array_dot(string $key, array $value, $default = null)
{
    foreach (explode('.', $key) as $key) {
        if (! isset($value[$key])) {
            return $default;
        }

        $value = $value[$key];
    }

    return $value;
}

function view(string $view, array $variables = [])
{
    $response = new \Core\Http\Response;

    $response->view($view, $variables);

    return $response;
}

/**
 * View helper for include view
 * separate path by dot
 *
 * @param string $view
 * @return mixed
 */
function include_view(string $view, array $variables = [])
{
    extract($variables);

    include View::resolve($view);
}

/**
 * Get application
 *
 * @return \Core\Contracts\ApplicationContract
 */
function app()
{
    return Container::make(ApplicationContract::class);
}

/**
 * Undocumented function
 *
 * @return Core\Http\Request
 */
function request()
{
    return app()->container()->make(Request::class);
}

/**
 * Undocumented function
 *
 * @return \Core\Http\Response
 */
function response()
{
    return app()->container()->make(Response::class);
}

/**
 * Undocumented function
 *
 * @return \Core\Http\Response
 */
function redirect(string $to)
{
    return response()->redirect($to);
}

/**
 * Undocumented function
 *
 * @return \Core\Http\Response
 */
function back()
{
    return redirect(request()->referer());
}

/**
 * Get session
 *
 * @return \Core\Http\Session
 */
function session($action = null)
{
    /**
     * @var \Core\Http\Session
     */
    $session = app()->container()->make(Session::class);

    if (is_string($action)) {
        return $session->get($action);
    }

    if (is_array($action)) {
        foreach ($action as $key => $value) {
            $session->put($key, $value);
        }

        return;
    }

    return $session;
}

/**
 * Get auth
 *
 * @return \Core\Http\Auth
 */
function auth()
{
    return app()->container()->make(Auth::class);
}

/**
 * Get error in session flash
 *
 * @param string $key
 * @return mixed|false
 */
function error(string $key)
{
    return session()->old("errors.$key", false);
}

function input(string $key, $default = null)
{
    return session()->old("inputs.$key", $default);
}

/**
 * Get old parameter in session
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function old(string $key, $default = null)
{
    return session()->old($key, $default);
}

function dd(...$any)
{
    var_dump(...$any); die;
}
