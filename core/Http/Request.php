<?php

namespace Core\Http;

class Request
{
    public function get(string $key)
    {
        return $_GET[$key] ?? null;
    }

    public function post(string $key)
    {
        return $_POST[$key] ?? null;
    }

    public function file(string $key)
    {
        return is_array($_FILES[$key])
            ? new FileUpload($_FILES[$key])
            : null;
    }

    public function only(array $keys)
    {
        $values = [];

        foreach ($keys as $key) {
            $values[$key] = $this->{$key};
        }

        return $values;
    }

    public function all()
    {
        return array_merge($_GET, $_POST);
    }

    public function referer()
    {
        return $_SERVER["HTTP_REFERER"] ?? null;
    }

    public function __get(string $key)
    {
        return $this->get($key) ?? $this->post($key);
    }
}
