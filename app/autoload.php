<?php

spl_autoload_register(
/**
 * @throws RuntimeException
 */
    static function (string $class) {
        $folderNamespaces = [
            'App' => 'app',
        ];

        $class = str_replace('\\', '/', $class);
        $file = __DIR__ . '/../' . $class . '.php';

        foreach ($folderNamespaces as $namespace => $path) {
            if (str_contains($file, $namespace)) {
                $file = preg_replace('/' . $namespace . '/', $path, $file, 1);
            }
        }

        if (file_exists($file)) {
            require_once $file;
            return;
        }

        throw new RuntimeException("Class {$class} not found");
    },
);
