<?php

declare(strict_types=1);

namespace Tests\Integration;

use Source\Core\Connection;
use PHPUnit\Framework\TestCase;
use Laminas\Diactoros\ServerRequest;

class TestTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->dbInstance = (Connection::getInstance())->getConnection();
    }

    protected function setUp(): void
    {
        $this->request = new ServerRequest([], [], null, null, 'php://memory');
    }

    public function testStore3()
    {
        var_dump($this->dbInstance->query('SELECT * FROM vehicle')->fetch());
        $this->expectNotToPerformAssertions();
    }

    public function testStore4()
    {
        var_dump($this->dbInstance->query('SELECT * FROM vehicle')->fetch());
        $this->expectNotToPerformAssertions();
    }
}
