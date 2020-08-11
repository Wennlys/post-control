<?php

declare(strict_types=1);

namespace Tests\Integration;

use Source\Core\Connection;
use PHPUnit\Framework\TestCase;
use Laminas\Diactoros\ServerRequest;
use Source\App\Http\ArticleStoreController;

class TestTestTest extends TestCase
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

    public function testStore()
    {
        // $json = json_encode(['title' => 'title', 'content' => 'content']);
        // $this->request->getBody()->write($json);
        // $response = (new ArticleStoreController($this->dbInstance))->store($this->request);
        // // $this->assertSame($json, (string) $response->getBody());
        var_dump($this->dbInstance->query('SELECT * FROM vehicle')->fetch());
        $this->expectNotToPerformAssertions();
    }

    public function testStore2()
    {
        var_dump($this->dbInstance->query('SELECT * FROM vehicle')->fetch());
        $this->expectNotToPerformAssertions();
    }
}
