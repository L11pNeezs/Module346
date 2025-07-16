<?php

namespace App\Libraries\Core\Http\RestaurantValidator;

use App\Models\Restaurant;

class RestaurantValidator
{
    protected $constraints;

    public function __construct()
    {
        $this->constraints = require __DIR__ . '/../../../../../config/restaurant_validation.php';
    }

    public function validateData(array $data): array
    {
        $errors = [];

        foreach ($this->constraints as $field => $rules) {
            $value = $data[$field] ?? '';

            if (!empty($rules['required']) && empty(trim($value))) {
                $errors[$field] = $rules['messages']['required'];
                continue;
            }

            if (isset($rules['min_length']) && strlen(trim($value)) < $rules['min_length']) {
                $errors[$field] = $rules['messages']['min_length'];
                continue;
            }

            if (isset($rules['max_length']) && strlen(trim($value)) > $rules['max_length']) {
                $errors[$field] = $rules['messages']['max_length'];
                continue;
            }

            if ($field === 'image' && !empty($value)) {
                if (!filter_var($value, FILTER_VALIDATE_URL)) {
                    $errors[$field] = $rules['messages']['valid_url'];
                    continue;
                }
                if (!preg_match($rules['pattern'], $value)) {
                    $errors[$field] = $rules['messages']['valid_image'];
                    continue;
                }
            }
        }
        return $errors;
    }

    public function getConceptOptions(): array
    {
        return Restaurant::getConcepts();
    }

    public function getPriceTierOptions(): array
    {
        return Restaurant::getPriceTiers();
    }

    public function getDietOptions(): array
    {
        return Restaurant::getDiets();
    }
}
