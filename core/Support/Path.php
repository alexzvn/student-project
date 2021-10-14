<?php

namespace Core\Support;

class Path
{
    public static function join(string ...$paths)
    {
        $paths = array_map(function ($path) {
            return rtrim($path, '/');
        }, $paths);

        return implode('/', $paths);
    }
}

