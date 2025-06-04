<?php

namespace app\Libraries\Core\Http;

use JsonException;
use RuntimeException;

class Request
{
    public string $method;
    public string $uri;
    public array $headers;
    public array $queryParams;
    public array $bodyParams;

    private function __construct(string $method, string $uri, array $headers = [], array $queryParams = [], array $bodyParams = [])
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->queryParams = $queryParams;
        $this->bodyParams = $bodyParams;
    }

    public static function fromServer(): self
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_ends_with($uri, '/') ? rtrim($uri, '/') : $uri;
        $headers = getallheaders();
        $queryParams = [];
        $bodyParams = [];

        if (str_contains($uri, '?')) {
            [$uri, $queryString] = explode('?', $uri, 2);
            parse_str($queryString, $queryParams);
        }

        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            if ($headers['Content-Type'] === 'application/json') {
                try {
                    $bodyParams = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
                } catch (JsonException) {
                    throw new RuntimeException('Unable to parse the request body string.');
                }
            } else {
                $bodyParams = $_POST ?? [];
            }
        }

        return new self($method, $uri, $headers, $queryParams, $bodyParams);
    }

    public string $path
        {
            get => parse_url($this->uri, PHP_URL_PATH);
        }

    public function all(): array
    {
        return [
            ...$this->queryParams,
            ...$this->bodyParams,
        ];
    }
}
