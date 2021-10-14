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

    public function __get(string $key)
    {
        return $this->get($key) ?? $this->post($key);
    }
}
