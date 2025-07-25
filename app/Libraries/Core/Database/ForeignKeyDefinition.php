<?php

namespace App\Libraries\Core\Database;

class ForeignKeyDefinition
{
    private array $definition;

    public function __construct(array &$definition)
    {
        $this->definition = &$definition;
    }

    public function references(string $column): static
    {
        $this->definition['parameters']['reference'] = $column;
        return $this;
    }

    public function on(string $table): static
    {
        $this->definition['parameters']['on'] = $table;
        return $this;
    }

    public function onDelete(string $action): static
    {
        $this->definition['parameters']['onDelete'] = $action;
        return $this;
    }

    public function onUpdate(string $action): static
    {
        $this->definition['parameters']['onUpdate'] = $action;
        return $this;
    }
}
