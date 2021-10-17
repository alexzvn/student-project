<?php

namespace Core\Http;

class Response
{
    protected array $headers = [];

    /**
     * View object
     *
     * @var \Core\Http\View
     */
    protected $view;

    public function redirect(string $to)
    {
        $this->header('Location', $to);

        return $this;
    }

    public function header(string $key, string $value)
    {
        $this->headers[$key] = $value;

        return $this;
    }

    public function view(string $view, array $variables = [])
    {
        $this->view = View::make($view, $variables);

        return $this;
    }

    public function toClient()
    {
        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        if (isset($this->view)) {
            $this->view->mixin();
        }
    }

    public static function send($any)
    {
        if ($any === null) {
            return;
        }

        switch (true) {
            case is_string($any) || is_int($any) || is_bool($any) || is_long($any): echo $any; break;
            case $any instanceof Response: $any->toClient(); break;

            default:
                $response = new static;
                $response->header('Content-Type', 'application/json');
                $response->toClient();
                echo json_encode($any);
                break;
        }
    }
}

