<?php

declare(strict_types=1);

namespace Source\Core;

use PDO;

class MySqlConnection extends Connection
{
    private function __construct()
    {
        $this->conn = new PDO(
            'mysql:host=' . SQL_DB['HOST'] . ';dbname=' . SQL_DB['NAME'],
            SQL_DB['USER'],
            SQL_DB['PASS'],
            self::OPTIONS
        );
    }
}
