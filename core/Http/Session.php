<?php

namespace Core\Http;

class Session
{
    public function __construct() {
        session_start();
    }

    function flash(string $key, $value)
    {
        $_SESSION["flash.$key"] = $value;
    }

    public function put(string $key, $value)
    {
        $_SESSION["data.$key"] = $value;
    }

    public function get(string $key, $default = null)
    {
        return $_SESSION["data.$key"] ?? $_SESSION["flash.$key"] ?? $this->old($key) ?? $default;
    }

    public function old(string $key, $default = null)
    {
        return $_SESSION["old.$key"] ?? $default;
    }

    public function forget(string $key)
    {
        unset($_SESSION["data.$key"]);
    }

    public function destroy()
    {
        session_destroy();
    }

    protected function moveFlash()
    {
        foreach ($_SESSION as $key => $value) {
            if (preg_match('/^flash/', $key)) {
                unset($_SESSION[$key]);

                $key = preg_replace('/^flash/', 'old', $key);
                $_SESSION[$key] = $value;
            }
        }
    }

    public function clearLastFlash()
    {
        foreach ($_SESSION as $key => $value) {
            if (preg_match('/^old/', $key)) {
                unset($_SESSION[$key]);
            }
        }
    }

    public function __get(string $key)
    {
        return $this->get($key) ?? $this->old($key);
    }

    public function __set(string $key, $value)
    {
        $this->put($key, $value);
    }

    public function __destruct()
    {
        $this->clearLastFlash();
        $this->moveFlash();
    }
}
