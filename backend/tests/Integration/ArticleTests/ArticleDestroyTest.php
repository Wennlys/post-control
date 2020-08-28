<?php

declare(strict_types=1);

namespace Tests\Integration;

use Mocks\IntegrationTestCase;
use Source\App\Http\ArticleDestroyAction;

class ArticleDestroyTest extends IntegrationTestCase
{
    public function __construct()
    {
        parent::__construct(ArticleDestroyAction::class);
    }

    public function testArticleDestroying()
    {
        $response = $this->request([], ['id' => 1]);
        $this->assertTrue($response['success']);
    }

    /** @test */
    public function idMustExist()
    {
        $response = $this->request([], ['id' => 99999999999]);
        $this->assertFalse($response['success']);
    }
}
