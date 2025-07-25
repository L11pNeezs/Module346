<?php

namespace App\Libraries\Core\Database;

use App\Libraries\Core\Column;
use App\Libraries\Core\Facades\DB;

class Blueprint
{
    private string $tableName;

    private array $columns = [];

    private array $commands = [];

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function build(): void
    {
        $foreignKeys = $this->compileForeignKeys();
        DB::createTable($this->tableName, $this->columns, $foreignKeys);
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
            'name' => $columnName,
            'type' => Type::Geometry,
            'typeParameters' => [$geometryType, $srid],
            'nullable' => true,
        ]);
        $this->columns[$columnName] = $columns;

        return $columns;
    }

    protected function addCommand($type, $parameters = []): array
    {
        $command = [
            'type' => $type,
            'parameters' => $parameters,
        ];

        $this->commands[] = $command;
        return $command;
    }

    public function foreign(string $column): ForeignKeyDefinition
    {
        $command = $this->addCommand('foreign', ['column' => $column]);
        return new ForeignKeyDefinition($command);
    }

    public function on(string $table): ForeignKeyDefinition
    {
        $command = $this->addCommand('on', ['table' => $table]);
        return new ForeignKeyDefinition($comand);
    }

    public function references(string $column): ForeignKeyDefinition
    {
        $command =  $this->addCommand('references', ['column' => $column]);
        return new ForeignKeyDefinition($command);
    }

    public function compileForeignKeys(): array
    {
        $foreignKeysSql = [];

        foreach ($this->commands as $command) {
            if ($command['type'] === 'foreign') {
                $params = $command['parameters'];

                $column = "\"{$command['parameters']['column']}\"" ?? null;
                $reference = "\"{$command['parameters']['reference']}\"" ?? null;
                $on = $params['on'] ?? null;
                $onDelete = $params['onDelete'] ?? null;
                $onUpdate = $params['onUpdate'] ?? null;

                $sql = "FOREIGN KEY ($column) REFERENCES \"$on\"($reference)";

                if ($onDelete) {
                    $sql .= " ON DELETE $onDelete";
                }

                if ($onUpdate) {
                    $sql .= " ON UPDATE $onUpdate";
                }

                $foreignKeysSql[] = $sql;
            }
        }

        return $foreignKeysSql;
    }
}
