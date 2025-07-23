<?php

namespace App\Libraries\Core\Database;

use App\Libraries\Core\Column;
use App\Libraries\Core\Facades\DB;

class Blueprint
{
    private string $tableName;

    private array $columns = [];

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function build(): void
    {
        DB::createTable($this->tableName, $this->columns);
    }

    public function id(): void
    {
        $this->columns['id'] = Column::fromArray([
            'name' => 'id',
            'type' => Type::BigIncrement,
            'primaryKey' => true,
        ]);
    }

    public function string(string $columnName, ?int $length = null): Column
    {
        $columns = Column::fromArray([
            'name' => $columnName,
            'type' => $length ? Type::VarChar : Type::Text,
            'length' => $length,
        ]);
        $this->columns[$columnName] = $columns;
        return $columns;
    }

    public function timestamps(): void
    {
        $this->columns['created_at'] = Column::fromArray([
            'name' => 'created_at',
            'type' => Type::Timestamp,
            'nullable' => true,
        ]);
        $this->columns['updated_at'] = Column::fromArray([
            'name' => 'updated_at',
            'type' => Type::Timestamp,
            'nullable' => true,
        ]);
    }

    public function bool(string $columnName): void
    {
        $this->columns[$columnName] = Column::fromArray([
            'name' => $columnName,
            'type' => Type::Bool,
            'nullable' => true,
        ]);
    }

    public function geometry(string $columnName, string $geometryType = 'Point', $srid = 4326): Column
    {
        $columns = Column::fromArray([
            'name' =>  $columnName,
            'type' => Type::Geometry,
            'typeParameters' =>  [$geometryType, $srid],
            'nullable' => true,
         ]);
        $this->columns[$columnName] = $columns;
        return $columns;
    }
}
