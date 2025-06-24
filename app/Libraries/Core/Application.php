<?php

namespace App\Libraries\Core;

use App\Libraries\Core\Console\AbstractCommand;
use App\Libraries\Core\Facades\DB;
use App\Libraries\Core\Http\Request;
use RuntimeException;

final class Application
{
    private Container $container;

    public function __construct(
        Container $container
    ) {
        $this->container = $container;

        Debugger::setGlobalExceptionHandler();
        Dotenv::load();
        $this->loadHelpers();
        Configuration::load();
    }

    public static function boot(): self
    {
        $container = Container::getInstance();
        $app = $container->make(self::class, [
            Container::class => fn () => $container,
        ]);

        $app->loadRoutes();

        app('database', static function () {
            $defaultDatabase = config('database.default', 'pgsql');
            $databaseConfig = config("database.connections.$defaultDatabase", []);

            return DB::fromConfig($defaultDatabase, $databaseConfig);
        });

        return $app;
    }

    public function handleRequest(): void
    {
        $request = Request::fromServer();

        $response = app(Router::class)->getResponseFromRequest($request);

        http_response_code($response->code);
        foreach ($response->headers as $header) {
            header($header);
        }

        echo $response->response;
    }

    public function handleCommand(): int
    {
        $dir = __DIR__.'/../../Console';
        $files = scandir($dir);
        $commands = [];
        foreach ($files as $file) {
            if (! is_file($dir.'/'.$file) || pathinfo($file, PATHINFO_EXTENSION) !== 'php') {
                continue;
            }

            $className = 'App\\Console\\'.pathinfo($file, PATHINFO_FILENAME);
            $instance = $this->container->make($className);
            if (! $instance instanceof AbstractCommand) {
                continue;
            }
            $commands[$instance->getName()] = $instance;
        }

        $command = $_SERVER['argv'][1] ?? null;

        if (! array_key_exists($command, $commands)) {
            throw new RuntimeException('Command not found');
        }

        return $commands[$command]->handle();
    }

    private function loadHelpers(): void
    {
        require_once __DIR__.'/../../helpers.php';
    }

    private function loadRoutes(): void
    {
        require_once __DIR__.'/../../../routes/web.php';
        require_once __DIR__.'/../../../routes/admin.php';
    }
}
