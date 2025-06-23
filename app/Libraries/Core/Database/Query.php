<?php

namespace App\Libraries\Core\Database;

class Query
{
    public string $tableName;
    protected array $columns;
    protected ?string $type;
    protected array $where = [];
    protected array $orderBy = [];
    protected array $limit = [];

    public function __construct(string $tableName, ?string $type = null)
    {
        $this->tableName = $tableName;
        $this->type = $type;
        $this->columns = [];
    }

    public function isSelect(): bool
    {
        return $this->type === 'select';
    }

    public function isInsert(): bool
    {
        return $this->type === 'insert';
    }

    public function hasWhere(): bool
    {
        return ! $this->isInsert() && ! empty($this->where);
    }

    public function hasLimit(): bool
    {
        return $this->isSelect() && ! empty($this->limit);
    }

    public function insert(array $data): string|false
    {
        $this->type = 'insert';
        $this->columns = $data;
        return app('database')->execute($this);
    }

    public function orderBy(string $command): static
    {
        $this->orderBy[] = $command;
        return $this;
    }

    public function setColumns(array $columns): static
    {
        $this->columns = $columns;
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns === [] ? ['*'] : $this->columns;
    }

    public function where(string $column, string $operator, mixed $value): static
    {
        return $this->andWhere($column, $operator, $value);
    }

    public function andWhere(string $column, string $operator, mixed $value): static
    {
        $this->where[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'logical' => 'AND',
        ];
        return $this;
    }

    public function get(): array
    {
        $this->type = 'select';
        return app('database')->execute($this);
    }

    public function getWhere()
    {
        return $this->where;
    }

    public function getOrderBy()
    {
        return $this->orderBy;
    }

    public function getLimit(): array
    {
        return $this->limit;
    }

    public function update(array $data)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function limit(int $number): static
    {
        $this->limit = [$number];
        return $this;
    }
}
