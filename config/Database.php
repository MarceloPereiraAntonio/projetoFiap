<?php

namespace Config;

use PDO;

class Database
{
    private static $conn = null;

    public static function getConnection(): PDO
    {
        if(self::$conn === null) {
            $host = $_ENV['DB_HOST'];
            $port = $_ENV['DB_PORT'];
            $database = $_ENV['DB_DATABASE'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            
            try {
                self::$conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false        
                    ]
                );
            } catch (\PDOException $e) {
                die('Error connecting to database: ' . $e->getMessage());
            }
        }

        return self::$conn;
    }
}