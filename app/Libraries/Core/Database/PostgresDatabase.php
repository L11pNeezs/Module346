<?php

namespace App\Libraries\Core\Database;

use App\Libraries\Core\Column;
use PDO;
use PDOStatement;
use PgSql\Result;
use RuntimeException;

final class PostgresDatabase extends AbstractDatabase
{
    public function connect(): void
    {
        $this->connection = new PDO("pgsql:host={$this->host};port={$this->port};dbname={$this->database}", $this->username, $this->password);
    }

    public function query(string $sql): false|PDOStatement
    {
        return $this->connection->query($sql);
    }

    public function createTable(string $tableName, array $columns): void
    {
        $sql = sprintf('CREATE TABLE IF NOT EXISTS "%s" (', $tableName);

        /** @var Column $column */
        foreach ($columns as $column) {
            $sql .= $column->getDefinition() . ",";
        }

        $sql = rtrim($sql, ',') . ");";

        $this->query($sql);
    }

    public function getColumnDefinition(Column $column): string
    {
        $type = self::getTypeMapping($column->type);
        $definition = "{$column->name} {$type}";

        if ($column->nullable) {
            $definition .= ' NULL';
        } else {
            $definition .= ' NOT NULL';
        }

        if ($column->primary) {
            $definition .= ' PRIMARY KEY';
        }

        return $definition;
    }

    protected static function getTypeMapping(Type $type): string
    {
        return match ($type) {
            Type::BigIncrement => 'BIGSERIAL',
            Type::VarChar => 'VARCHAR',
            Type::Text => 'TEXT',
            Type::Timestamp => 'TIMESTAMP',
            default => throw new RuntimeException('Unsupported column type'),
        };
    }

    protected function executeInsert(Query $query): false|string
    {
        $tableName = $query->tableName;
        $columns = implode(', ', array_keys($query->getColumns()));
        $values = implode(', ', array_map(fn($value) => $this->connection->quote($value), array_values($query->getColumns())));

        $sql = sprintf('INSERT INTO "%s" (%s) VALUES (%s)', $tableName, $columns, $values);
        $this->query($sql);
        return $this->connection->lastInsertId();
    }

    protected function executeSelect(Query $query): array
    {
        $sql = sprintf(
            'SELECT %s FROM %s',
            implode(', ', $query->getColumns()),
            $query->tableName,
        );

        if ($query->hasWhere()) {
            $sql .= ' WHERE ';

            $whereParameters = $query->getWhere();
            $numItems = count($whereParameters);
            $i = 0;

            foreach ($whereParameters as $where) {
                $sql .= sprintf(
                    '%s %s %s',
                    $where['column'],
                    $where['operator'],
                    $this->connection->quote($where['value']),
                );
                if (++$i !== $numItems) {
                    $sql .= ' ' . $where['logical'];
                }

            }
        }

        if ($result = $this->query($sql)) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function execute(Query $query): mixed
    {
        if ($query->isInsert()) {
            return $this->executeInsert($query);
        }

        if ($query->isSelect()) {
            return $this->executeSelect($query);
        }

        throw new RuntimeException('Unsupported query type');
    }

    public function dropTable(string $tableName): void
    {
        $this->query("DROP TABLE IF EXISTS \"$tableName\" CASCADE");
    }
}
