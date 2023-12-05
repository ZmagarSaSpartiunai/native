<?php

namespace DB;

use Dotenv\Dotenv;
use Exception;
use mysqli;

class ConnectionDb
{
    private static mysqli $db;

    private function __construct()
    {

        $dotenv = Dotenv::createImmutable(__DIR__ . '/..'); // Путь к директории с .env файлом
        $dotenv->load();
        $connect = mysqli_connect(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            $_ENV['DB_NAME'],
        );

        if ($connect) {
            self::$db = $connect;
        } else {
            throw new Exception("Failed to connect to the database");
        }
    }

    private function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new \ErrorException("Cannot unserialize singleton");
    }

    public static function getConnection(): mysqli
    {
        if (!isset(static::$db)) {
            new static();
        }

        return self::$db;
    }
}