<?php

namespace App\Libraries\Core\Database;

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

    public function __set(string $name, mixed $value): void
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

        return sprintf('%ss', strtolower($class));
    }

    public static function all(): array
    {
        $results = DB::select(self::getTableName())->get();

        return array_map(static function ($result) {
            $model = new static;
            foreach ($result as $key => $value) {
                $model->{$key} = $value;
            }

            return $model;
        }, $results);
    }

    public static function countAll(): int
    {
        $count = DB::select(self::getTableName())->count();

        return $count;
    }

    public static function getById(string $id): ?static
    {
        $result = DB::select(self::getTableName())
            ->where('id', '=', $id)
            ->get()[0] ?? null;

        if (! $result) {
            return null;
        }

        $model = new static;
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

        return self::getById($id);
    }

    public function save(): self|string
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

    public function delete(): string
    {
        $data = $this->data;
        if (! isset($data['id'])) {
            throw new RuntimeException('Failed to delete model instance.');
        }

        return DB::table(self::getTableName())
            ->where('id', '=', $data['id'])
            ->delete();
    }

    public static function find(string $column, $value): ?static
    {
        $result = DB::table(self::getTableName())
            ->where($column, '=', $value)->limit(1)
            ->get()[0] ?? null;

        if (! $result) {
            return null;
        }
        $model = new static;
        foreach ($result as $key => $value) {
            $model->{$key} = $value;
        }

        return $model;
    }

    public static function count(): int
    {
        return DB::select(self::getTableName())->count();
    }

    public static function paginate(int $perPage, int $pageNumber): array
    {

        $offset = ($pageNumber - 1) * $perPage;
        $results = DB::table(self::getTableName())
            ->limit($perPage)
            ->offset($offset)
            ->get();

        return array_map(static function ($result) {
            $model = new static;

            foreach ($result as $key => $value) {
                $model->{$key} = $value;
            }

            return $model;
        }, $results);
    }
}
