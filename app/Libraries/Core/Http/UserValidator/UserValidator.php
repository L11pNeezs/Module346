<?php

namespace App\Libraries\Core\Http\UserValidator;

class UserValidator
{

    protected $constraints;

    public function __construct()
    {
        $this->constraints = require __DIR__ . '/../../../../../config/user_validation.php';
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
            if ($field === 'email' && !empty($value)) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = $rules['messages']['valid_email'];
                    continue;
                }
            }
        }
        return $errors;
    }
}
