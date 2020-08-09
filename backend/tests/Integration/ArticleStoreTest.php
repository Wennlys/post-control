<?php

declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Source\Core\SqliteConnection;
use Laminas\Diactoros\ServerRequest;
use Source\App\Http\ArticleStoreController;

class ArticleStoreTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->dbInstance = SqliteConnection::getInstance();
    }

    protected function setUp(): void
    {
        $this->request = new ServerRequest([], [], null, null, 'php://memory');
    }

    public function testStore()
    {
        $json = json_encode(['title' => 'title', 'content' => 'content']);
        $this->request->getBody()->write($json);
        $response = (new ArticleStoreController($this->dbInstance))->store($this->request);
        $this->assertSame($json, (string) $response->getBody());
    }
}
