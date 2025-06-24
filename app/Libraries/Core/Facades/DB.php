<?php

namespace App\Libraries\Core\Facades;

use App\Libraries\Core\Database\AbstractDatabase;
use App\Libraries\Core\Database\PostgresDatabase;
use App\Libraries\Core\Database\Query;
use PDOStatement;
use RuntimeException;

final class DB
{
    public static function createTable(string $tableName, array $columns): void
    {
        app('database')->createTable($tableName, $columns);
    }

    public static function fromConfig(string $driver, mixed $databaseConfig): AbstractDatabase|PostgresDatabase
    {
        if (! in_array($driver, ['pgsql', 'mysql'])) {
            throw new RuntimeException('Unsupported database driver: '.$driver);
        }

        return match ($driver) {
            'pgsql' => PostgresDatabase::fromConfig($databaseConfig),
        };
    }

    public static function select(string $tableName, array $columns = ['*']): Query
    {
        return new Query($tableName, 'select')->setColumns($columns);
    }

    public static function table(string $tableName): Query
    {
        return new Query($tableName);
    }

    public static function raw(string $sql): false|PDOStatement
    {
        return app('database')->query($sql);
    }

    public static function dropTable(string $tableName): void
    {
        app('database')->dropTable($tableName);
    }
}
