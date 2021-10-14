<?php

namespace Core\Http;

use Core\Support\Path;

class View
{
    protected string $path;

    /**
     * Shared variable
     *
     * @var array
     */
    protected static array $share = [];

    protected array $variables;

    public function __construct(string $view) {
        $this->path = $this->resolve($view);
    }

    public static function resolve(string $view)
    {
        return Path::join(BASE_PATH, 'view', str_replace('.', '/', $view) . '.php');
    }

    public static function make(string $view, array $variables = [])
    {
        return (new static($view))->with($variables);
    }

    public static function share(string $key, $value)
    {
        static::$share[$key] = $value;
    }

    public function with(array $variables)
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Compose to html response
     *
     * @return void
     */
    public function mixin()
    {
        extract(array_merge(
            static::$share,
            $this->variables
        ));

        include $this->path;
    }
}
