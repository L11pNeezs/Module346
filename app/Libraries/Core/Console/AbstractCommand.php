<?php

namespace App\Libraries\Core\Console;

abstract class AbstractCommand
{
    public string $signature;

    public string $description;

    abstract public function handle(): int;

    public function getName(): string
    {
        return explode(' ', $this->signature)[0];
    }

    public function arguments(): array
    {
        $args = [];

        $signatureParts = explode(' ', $this->signature);
        foreach ($signatureParts as $part) {
            if (! preg_match('/^{-(\w+)}$/', $part, $matches)) {
                continue;
            }
            $args[$matches[1]] = null;
        }

        foreach ($_SERVER['argv'] as $arg) {
            if (! preg_match('/^-(\w)(?:=(.*))?$/', $arg, $matches)) {
                continue;
            }

            $argName = $matches[1];
            $value = $matches[2] ?? true;
            if (! array_key_exists($argName, $args)) {
                continue;
            }
            $args[$argName] = $value;
        }

        return $args;
    }
}
