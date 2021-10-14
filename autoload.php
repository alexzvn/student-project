<?php

spl_autoload_register(function (string $class) {
    $namespace = explode('\\', $class);

    $file = implode('/', [lcfirst(array_shift($namespace)), ...$namespace]) . ".php";
    $file = __DIR__ .  "/$file";

    if (file_exists($file)) {

        require_once $file;
    }
});
