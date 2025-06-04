<?php

namespace App\Console;

use app\Libraries\Core\Console\AbstractCommand;
use App\Libraries\Core\Router;

class ShowRoutes extends AbstractCommand
{
    public string $signature = 'routes:show';
    public string $description = 'Show all registered routes';

    public function handle(): int
    {
        $routes = app(Router::class)->getRoutes();

        foreach ($routes as $method => $uris) {
            foreach ($uris as $uri=>$args) {
                echo sprintf(
                    "%s %s -> %s\n",
                    $method,
                    $uri,
                    json_encode($args, JSON_THROW_ON_ERROR),
                );
            }
        }

        return 0;
    }
}