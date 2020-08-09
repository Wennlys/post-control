<?php

declare(strict_types=1);

namespace Source\Core;

use PDO;

class SqliteConnection extends Connection
{
    private function __construct()
    {
        $this->conn = new PDO('sqlite::memory:?cache=shared', null, null, self::OPTIONS);
    }
}
