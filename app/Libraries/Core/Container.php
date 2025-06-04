<?php

namespace App\Libraries\Core;

use App\Libraries\Core\Traits\HasSingleton;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use RuntimeException;

final class Container
{
    use HasSingleton;

    private array $instances = [];

    private function __construct() {}

    /**
     * @template T of object
     * @param class-string<T>|string $id
     * @return T|object
     */
    public function get(string $id): mixed
    {
        return $this->instances[$id] ?? $this->make($id);
    }

    /**
     * @template T of object
     * @param class-string<T>|string $id
     * @param mixed $instance
     * @return T|object
     */
    public function set(string $id, mixed $instance): mixed
    {
        if (is_callable($instance)) {
            $instance = $instance($this);
        }

        return $this->instances[$id] = $instance;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->instances);
    }

    /**
    * @template T of object
    * @param class-string<T>|string $id
    * @param array $providers
    * @return T|object
    */
    public function make(string $id, array $providers = []): mixed
    {
        try {
            $reflection = new ReflectionClass($id);
            if (!$reflection->isInstantiable()) {
                throw new RuntimeException("Class {$id} is not instantiable.");
            }

            $constructor = $reflection->getConstructor();
            if ($constructor === null) {
                $instance = $reflection->newInstance();
            } else {
                $parameters = $constructor->getParameters();
                $dependencies = [];
                foreach ($parameters as $parameter) {
                    $type = $parameter->getType();

                    if (! $type instanceof ReflectionNamedType) {
                        throw new RuntimeException("Cannot resolve parameter: {$parameter->getName()}");
                    }

                    if($type->isBuiltin()) {
                        continue;
                    }

                    if (isset($providers[$type->getName()])) {
                        $dependencies[] = $providers[$type->getName()]($this);

                    } elseif (isset($this->instances[$type->getName()])) {
                        $dependencies[] = $this->instances[$type->getName()];
                    } else {
                        $dependencies[] = $this->make($type->getName());
                    }
                }
                $instance = $reflection->newInstanceArgs($dependencies);
            }

            $this->instances[$id] = $instance;
            return $instance;
        } catch (ReflectionException $e) {
            throw new RuntimeException("Error creating instance of {$id}: " . $e->getMessage());
        }
    }
}