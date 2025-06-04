<?php

namespace App\Libraries\Core;

use App\Libraries\Core\Traits\HasSingleton;

class Dotenv
{
    use HasSingleton;

    public static function load(): void
    {
        $dotenv = self::getInstance();

        $envValues = $dotenv->getEnvFileValues();
        foreach ($envValues as $key => $value) {
            putenv("$key=$value");
        }
    }

    public static function get(string $name): mixed
    {
        return getenv($name) ?: null;
    }

    protected function getEnvFileValues(?string $filePath = null): array
    {
        $filePath ??= __DIR__ . '/../../../.env';

        if(! file_exists($filePath)) {
            return [];
        }

        $fileContent = file_get_contents($filePath);

        $lines = explode("\n", $fileContent);
        $envValues = [];

        foreach ($lines as $line) {
            if (empty(trim($line)) || str_starts_with(trim($line), '#')) {
                continue;
            }

            [$key, $value] = explode('=', trim($line), 2);
            $envValues[trim($key)] = trim($value);
        }

        return $envValues;
    }
}