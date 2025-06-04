<?php

namespace App\Libraries\Core\Database;

use PDO;

abstract class AbstractDatabase
{
    protected string $host;
    protected string $username;
    protected string $password;
    protected string $database;
    protected string $port;

    protected ?PDO $connection;

    protected function __construct(string $host, string $port, string $username, string $password, string $database)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
    }

    public static function fromConfig(?array $config = null): static
    {
        return new static(
            ...$config
        );
    }

    abstract public function connect(): void;

    abstract public function query(string $sql): mixed;

    abstract public function execute(Query $query): mixed;

    abstract function createTable(string $tableName, array $columns): void;
}
