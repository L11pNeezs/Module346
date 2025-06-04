<?php

namespace App\Libraries\Core;

use App\Libraries\Core\Traits\HasSingleton;

class Configuration
{
    use HasSingleton;

    protected static array $config = [];

    public static function load(): void
    {
        $config = self::getInstance();
        $configFiles = $config->getAllConfigFiles();

        foreach ($configFiles as $filePath) {
            $fileNameWithoutExt = pathinfo($filePath, PATHINFO_FILENAME);
            self::$config[$fileNameWithoutExt] = $config->getConfigFileValues($filePath);
        }
    }

    public static function get(string $name, mixed $default = null): mixed
    {
        return self::getInstance()->getConfigValue($name, $default);
    }

    protected function getAllConfigFiles(): array
    {
        $configFiles = [];
        $configDir = __DIR__ . '/../../../config';

        if (! is_dir($configDir)) {
            return $configFiles;
        }

        $files = scandir($configDir);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $configFiles[] = $configDir . '/' . $file;
            }
        }

        return $configFiles;
    }

    protected function getConfigFileValues(string $filePath): array
    {
        if (!file_exists($filePath)) {
            return [];
        }

        $configContent = file_get_contents($filePath);
        $configValues = [];

        if ($configContent) {
            $configValues = include($filePath);
        }

        return is_array($configValues) ? $configValues : [];
    }

    protected function getConfigValue(string $name, mixed $default)
    {
        $parts = explode('.', $name);
        $value = self::$config;

        foreach ($parts as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return $default;
            }
        }

        return $value ?? $default;
    }
}