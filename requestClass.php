<?php

class Request
{
    private string $order;
    private static Request $instance;

    public static function getInstance(): Request
    {
        if (empty(self::$instance)) {
            self::$instance = new Request();
        }
        return self::$instance;
    }

    public function setOrder(string $order): void
    {
        $this->order = $order;
    }

    public function __isset($name)
    {
        return $this->name = $name;
    }

    public function __get($name)
    {
        $orderLetters = str_split($this->order, 1);

        $letters = [
            'P' => 'post',
            'G' => 'get',
            'C' => 'cookie'
        ];

        foreach ($orderLetters as $letter){
            $method = $letters[$letter];
            $hasMethod = 'has' . ucfirst($method);

            if ($this->$hasMethod($name)) {
                return $this->$method($name);
            }
        }

        return null;
    }

    public function hasPost(string $name): bool
    {
            return isset($_POST[$name]);
    }

    public function post(string $name, $default = null)
    {
            return $_POST[$name] ?? $default;
    }

    public function hasGet(string $name): bool
    {
            return isset($_GET[$name]);
    }

    public function get(string $name, $default = null)
    {
            return $_GET[$name] ?? $default;
    }

    public function hasRequest(string $name): bool
    {
            return isset($_REQUEST[$name]);
    }

    public function request(string $name, $default = null)
    {
            return $_REQUEST[$name] ?? $default;
    }

    public function hasServer(string $name): bool
    {
            return isset($_SERVER[$name]);
    }

    public function server(string $name, $default = null)
    {
            return $_SERVER[$name] ?? $default;
     }

    public function hasSession(string $name): bool
    {
            return isset($_SESSION[$name]);
    }

    public function session(string $name, $default = null)
    {
            return $_SESSION[$name] ?? $default;
    }

    public function hasCookie(string $name): bool
    {
            return isset($_COOKIE[$name]);
    }

    public function cookie(string $name, $default = null)
    {
            return $_COOKIE[$name] ?? $default;
    }

    public function files(string $name, $default = null)
    {
        return $_FILES[$name] ?? $default;
    }

    public function hasFiles(string $name): bool
    {
        return isset($_FILES[$name]);
    }
}
