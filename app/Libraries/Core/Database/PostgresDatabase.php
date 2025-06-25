<?php

namespace App\Libraries\Core\Database;

use App\Libraries\Core\Column;
use PDO;
use PDOStatement;
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
            $sql .= $column->getDefinition() . ',';
        }

        $sql = rtrim($sql, ',') . ');';

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
        $values = implode(', ', array_map(fn ($value) => $this->connection->quote($value), array_values($query->getColumns())));

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
            $sql .= ' WHERE ' . $this->getWhereProcessedConditions($query);
        }

        if ($query->hasOrderBy()) {
            $command = $query->getOrderBy();
            $sql .= ' ORDER BY ' . implode(', ', $command);
        }

        if ($query->hasLimit()) {
            $sql .= ' LIMIT ' . (int)$query->getLimit();

            if ($query->hasOffset()) {
                $sql .= ' OFFSET ' . (int)$query->getOffset();
            }
        }

        if ($result = $this->query($sql)) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    protected function executeDelete(Query $query): string
    {
        $sql = sprintf(
            'DELETE FROM %s',
            $query->tableName,
        );

        if (!$query->hasWhere()) {
            throw new RuntimeException('Query condition missing!');
        }

        $sql .= ' WHERE ' . $this->getWhereProcessedConditions($query);
        $this->query($sql);
        return 'Deleted Successfully';
    }

    private function getWhereProcessedConditions(Query $query): string
    {
        $whereParameters = $query->getWhere();
        $numItems = count($whereParameters);
        $i = 0;
        $sql = '';

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

        return $sql;
    }

    protected function executeUpdate(Query $query): string
    {
        $sql = sprintf(
            'UPDATE %s SET ',
            $query->tableName,
        );

        $columns = array_keys($query->getColumns());
        $values = array_map(fn ($value) => $this->connection->quote($value), array_values($query->getColumns()));
        $assignments = array_combine($columns, $values);
        $numAssignments = count($assignments);
        $i = 0;

        foreach ($assignments as $column => $value) {
            $sql .= sprintf(
                '%s = %s',
                $column,
                $value,
            );
            if (++$i !== $numAssignments) {
                $sql .= ', ';
            }
        }

        if (!$query->hasWhere()) {
            throw new RuntimeException('Query condition missing!');
        }

        $this->hydrateWhere($sql, $query);
        return 'Updated Successfully';
    }

    public function execute(Query $query): mixed
    {
        if ($query->isInsert()) {
            return $this->executeInsert($query);
        }

        if ($query->isSelect()) {
            return $this->executeSelect($query);
        }

        if ($query->isDelete()) {
            return $this->executeDelete($query);
        }

        if ($query->isUpdate()) {
            return $this->executeUpdate($query);
        }

        throw new RuntimeException('Unsupported query type');
    }

    public function dropTable(string $tableName): void
    {
        $this->query("DROP TABLE IF EXISTS \"$tableName\" CASCADE");
    }
}
