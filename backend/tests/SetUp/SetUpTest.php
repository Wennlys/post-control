<?php

declare(strict_types=1);

namespace Tests\Integration;

use Source\Core\Connection;
use PHPUnit\Framework\TestCase;

class SetUpTest extends TestCase
{
    /** @test */
    public function setUpDatabase()
    {
        $db = (Connection::getInstance())->getConnection();

        $db->exec(
            "CREATE TABLE vehicle(
              vehicleId INT NOT NULL,
              make VARCHAR(64),
              model VARCHAR(128),
              derivative VARCHAR(255),
              PRIMARY KEY(vehicleId)
            );

            INSERT INTO vehicle VALUES(1000,'Volkswagen','Golf','1.5 TSI EVO Match Edition 5dr');"
        );

        $this->expectNotToPerformAssertions();
    }
}
