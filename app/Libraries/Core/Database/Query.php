<?php

namespace App\Libraries\Core\Database;

class Query
{
    public string $tableName;

    protected array $columns;

    protected ?string $type;

    protected array $where = [];

    protected ?int $limit = null;
    protected ?int $offset = null;

    protected array $orderBy = [];

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

    public function isDelete(): bool
    {
        return $this->type === 'delete';
    }

    public function hasWhere(): bool
    {
        return ! $this->isInsert() && ! empty($this->where);
    }

    public function hasLimit(): bool
    {
        return $this->isSelect() && $this->limit !== null;
    }

    public function hasOffset(): bool
    {
        return $this->isSelect() && $this->offset !== null;
    }

    public function hasOrderBy(): bool
    {
        return $this->isSelect() && ! empty($this->orderBy);
    }

    public function orderBy(string $command): static
    {
        $this->orderBy[] = $command;

        return $this;
    }

    public function insert(array $data): string|false
    {
        $this->type = 'insert';
        $this->columns = $data;

        return app('database')->execute($this);
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

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function getOrderBy(): array
    {
        return $this->orderBy;
    }

    public function update(array $data)
    {
        throw new \RuntimeException('Not implemented');
    }

    public function delete(): string
    {
        $this->type = 'delete';

        return app('database')->execute($this);
    }

    public function limit(int $number): static
    {
        $this->limit = $number;

        return $this;
    }

    public function offset(int $number): static
    {
        $this->offset = $number;

        return $this;
    }
}
