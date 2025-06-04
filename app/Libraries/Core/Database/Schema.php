<?php

namespace App\Libraries\Core\Database;

use App\Libraries\Core\Facades\DB;
use Closure;

class Schema
{
    private function __construct()
    {
    }

    public static function create(string $table, Closure $callback): void
    {
        $blueprint = new Blueprint($table);
        $callback($blueprint);

        $blueprint->build();
    }

    public static function getAllTables(): array
    {
        $tables = DB::select('information_schema.tables')
            ->where('table_schema', '=', 'public')
            ->get();
        return array_map(static fn($table) => $table['table_name'], $tables);
    }

    public static function hasTable(string $name): bool
    {
        return array_any(self::getAllTables(), static fn($table) => $table['table_name'] === $name);
    }

    public static function dropAllTables(): void
    {
        $tables = self::getAllTables();
        foreach ($tables as $table) {
            DB::dropTable($table);
        }
    }
}
