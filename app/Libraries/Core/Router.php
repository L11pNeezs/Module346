<?php

namespace App\Libraries\Core;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Libraries\Core\Http\Request;
use App\Libraries\Core\Http\Response;
use App\Libraries\Core\Traits\HasSingleton;
use Closure;
use RuntimeException;

class Router
{
    protected static array $routes = [];

    protected array $groupOptions = [
        'prefix' => '',
    ];

    public function getResponseFromRequest(Request $request): Response
    {
        $response = null;

        $route = $this->getRoute($request->method, $request->path);
        if (! $route) {
            return Response::fromString(view('404'));
        }

        if (is_array($route)) {
            [$controller, $action] = $route;

            $controller = new $controller();
            if(! $controller instanceof AbstractController) {
                throw new RuntimeException('Class '. $controller::class . ' is not a valid Controller');
            }

            $response = $controller->$action();
        } elseif ($route instanceof Closure) {
            $response = $route();
        }

        if (is_string($response)) {
            return Response::fromString($response);
        }

        if(is_array($response)) {
            return Response::fromArray($response);
        }

        if (! $response instanceof Response) {
            throw new RuntimeException('No valid response returned from route.');
        }

        return $response;
    }

    public static function group(array $options, Closure $routes): void
    {
        app(self::class)->setGroup($options, $routes);
    }


    public static function get($url, array|Closure $route): void
    {
        app(self::class)->addRoute('GET', $url, $route);
    }

    public static function post($url, array|Closure $route): void
    {
        app(self::class)->addRoute('POST', $url, $route);
    }

    public static function put($url, array|Closure $route): void
    {
        app(self::class)->addRoute('PUT', $url, $route);
    }

    public static function patch($url, array|Closure $route): void
    {
        app(self::class)->addRoute('PATCH', $url, $route);
    }

    public static function delete($url, array|Closure $route): void
    {
        app(self::class)->addRoute('DELETE', $url, $route);
    }

    protected function setGroup(array $options, Closure $routes): void
    {
        $previousGroupOptions = $this->groupOptions;

        foreach ($this->groupOptions as $option => $value) {
            if (! isset($options[$option])) {
                continue;
            }

            if ($option === 'prefix') {
                $this->groupOptions['prefix'] .= '/' . $options[$option];
            }
        }

        $routes();

        $this->groupOptions = $previousGroupOptions;
    }

    protected function addRoute(string $method, string $url, array|Closure $route): void
    {
        if ($this->groupOptions['prefix']) {
            $url = $this->groupOptions['prefix'] . $url;
        }

        if($url !== '/' && str_ends_with($url, '/')) {
            $url = substr($url, 0, -1);
        }

        self::$routes[$method][$url] = $route;
    }

    protected function getRoute(string $method, string $path): array|Closure|null
    {
        return self::$routes[$method][$path] ?? self::$routes[$method][$path . '/'] ?? null;
    }

    public function getRoutes(): array
    {
        return self::$routes;
    }
}
