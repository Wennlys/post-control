<?php

declare(strict_types=1);

namespace Source\Core;

use PDO;
use Exception;
use PDOException;

abstract class Connection
{
    protected const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
    ];

    /** @var Exception|PDOException */
    public static $error;

    private ?PDO $conn = null;

    private static ?Connection $instance = null;

    public static function getInstance(): ?self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
