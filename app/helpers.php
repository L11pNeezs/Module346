<?php

declare(strict_types=1);

use App\Libraries\Core\Configuration;
use App\Libraries\Core\Container;
use App\Libraries\Core\Debugger;
use App\Libraries\Core\Dotenv;

if (! function_exists('app')) {
    /**
     * @template T of object
     *
     * @param  class-string<T>|string  $id
     * @return T|object
     */
    function app(string $id, mixed $instance = null): mixed
    {
        if (! $instance) {
            return Container::getInstance()->get($id);
        }

        if (is_callable($instance) || is_object($instance)) {
            return Container::getInstance()->set($id, $instance);
        }

        throw new InvalidArgumentException('Invalid instance type provided for app() function. Expected callable or object.');
    }
}

if (! function_exists('view')) {
    function view(string $view, array $data = []): string
    {
        ob_start();
        extract($data);
        $view = str_replace('.', '/', $view);
        include __DIR__."/../resources/Templates/header.php";
        include __DIR__."/../resources/views/{$view}.php";
        include __DIR__."/../resources/Templates/footer.php";

        return ob_get_clean();
    }
}

if (! function_exists('dd')) {
    function dd(...$args): void
    {
        Debugger::debugAndDie(...$args);
    }
}

if (! function_exists('request')) {
    function request(): \App\Libraries\Core\Http\Request
    {
        return \App\Libraries\Core\Http\Request::fromServer();
    }
}

if (! function_exists('env')) {
    function env(string $name, mixed $default = null): mixed
    {
        $value = Dotenv::get($name);

        return $value !== false ? $value : $default;
    }
}

if (! function_exists('config')) {
    function config(string $name, mixed $default = null): mixed
    {
        return Configuration::get($name, $default);
    }
}
