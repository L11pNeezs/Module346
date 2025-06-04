<?php

namespace App\Libraries\Core\Traits;

Trait HasSingleton {
    private static ?self $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}
}