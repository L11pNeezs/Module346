<?php

namespace App\Libraries\Core;

use App\Libraries\Core\Database\Type;

class Column
{
    public string $name;

    public Type $type;
    public ?array $typeParameters;

    public bool $nullable = false;

    public bool $primary = false;

    public function __construct(string $name, Type $type, ?array $typeParameters = null, bool $nullable = false, bool $primary = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->typeParameters = $typeParameters;
        $this->nullable = $nullable;
        $this->primary = $primary;
    }

    public static function fromArray(array $array): static
    {
        return new static(
            name: $array['name'],
            type: $array['type'],
            typeParameters:  $array['typeParameters'] ?? null,
            nullable: $array['nullable'] ?? false,
            primary: $array['primaryKey'] ?? false
        );
    }

    public function getDefinition(): string
    {
        return app('database')->getColumnDefinition($this);
    }

    public function nullable(bool $isNullable = true): static
    {
        $this->nullable = $isNullable;

        return $this;
    }
}
