<?php

use Core\Container;
use Core\Contracts\ApplicationContract;
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

function value(callable $callback)
{
    return $callback();
}

function config(string $key, $default = null)
{
    static $config;

    if ($config === null) {
        $config = require base_path('config.php');
    }

    $value = $config;

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

function include_view(string $view)
{
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
