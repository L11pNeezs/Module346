<?php

namespace App\Libraries\Core\Http;

use JsonException;
use RuntimeException;

class Response
{
    public int $code = 200;
    public string $response = '';
    public array $headers = [];

    public static function fromString(string $response): self
    {
        $instance = new self();
        $instance->response = $response;
        return $instance;
    }

    public static function fromArray(array $response)
    {
        $instance = new self();
        $instance->headers = [
            'Content-Type: application/json',
        ];

        try {
            $instance->response = json_encode($response, JSON_THROW_ON_ERROR);
            return $instance;
        } catch (JsonException $e) {
            throw new RuntimeException('Unable to encode response to JSON: ' . $e->getMessage());
        }
    }
}
