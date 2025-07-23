<?php

namespace App\DTO;

class RestaurantCriteriaDTO
{
    public ?string $concept = null;

    public ?string $diet = null;

    public ?int $priceTier = null;

    public function __construct(array $criteria)
    {
        $this->concept = $criteria['concept'] ?? null;
        $this->diet = $criteria['diet'] ?? null;
        $this->priceTier = isset($data['price_tier']) ? (int) $data['price_tier'] : null;
    }
}
