<?php

namespace App\Libraries\Core;

class Debugger
{
    public static function debugAndDie(...$vars): void
    {
        echo '<pre>';
        foreach ($vars as $var) {
            var_dump($var);
        }
        echo '</pre>';

        exit;
    }

    public static function setGlobalExceptionHandler(): void
    {
        set_exception_handler(static function ($exception) {
            echo '<pre>';
            echo 'Uncaught Exception: ' . $exception->getMessage() . "\n";
            echo 'Stack trace:' . "\n";
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        });
    }
}