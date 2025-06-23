<?php

namespace App\Libraries\Core\Database;

use AllowDynamicProperties;
use App\Libraries\Core\Facades\DB;
use ReflectionClass;
use RuntimeException;

abstract class Model
{
    protected array $data = [];
    public bool $timestamps = true;

    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    public function __set(string $name, mixed $value):void
    {
      $this->data[$name] = $value;
    }

    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    public static function getTableName(): string
    {
        $class = new ReflectionClass(static::class)->getShortName();
        return sprintf("%ss", strtolower($class));
    }

    public static function all(): array
    {
        $results = DB::select(self::getTableName())->get();

        return array_map(static function ($result) {
            $model = new static();
            foreach ($result as $key => $value) {
                $model->{$key} = $value;
            }
            return $model;
        }, $results);
    }

    public static function find(string $id): ?static
    {
        $result = DB::select(self::getTableName())
            ->where('id', '=', $id)
            ->get()[0] ?? null;

        if (! $result) {
            return null;
        }

        $model = new static();
        foreach ($result as $key => $value) {
            $model->{$key} = $value;
        }
        return $model;
    }

    public static function create(array $data): ?static
    {
        $id = DB::table(self::getTableName())->insert($data);

        if (! $id) {
            throw new RuntimeException('Failed to create model instance.');
        }

        return self::find($id);
    }

    public static function randomRestaurant(): string
    {
        $result = DB::select(self::getTableName())
            ->limit(1)
            ->get()[0] ?? null;
        return $result['name'] ?? 'No restaurant found';
    }

    public function save(): self
    {
        $data = $this->data;
        if ($this->timestamps) {
            $now = date('Y-m-d H:i:s');
            $data['created_at'] = $data['created_at'] ?? $now;
            $data['updated_at'] = $now;
        }

        if (isset($data['id'])) {
            return DB::table(self::getTableName())
                ->where('id', '=', $data['id'])
                ->update($data);
        }

        return self::create($data);
    }
}
