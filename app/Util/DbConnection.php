<?php

declare(strict_types=1);

namespace App\Util;

use App\Util\Interfaces\Connection;

final class DbConnection implements Connection
{
    public static $instance;
    private $connection;

    private function __construct()
    {
        $this->connection = new \mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
        $this->connection->query("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        if ($this->connection->connect_error) {
            throw new \Exception('Connection failed: '.$this->connection->connect_error);
        }
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a DbConnection.');
    }

    public static function getInstance(): Connection
    {
        if (!isset(self::$instance)) {
            self::$instance = new DbConnection();
        }

        return self::$instance;
    }

    public function connect()
    {
        return $this->connection;
    }
}
