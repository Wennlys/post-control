<?php

declare(strict_types=1);

namespace Tests\Integration;

use Mocks\IntegrationTestCase;
use Source\App\Http\ArticleShowAction;

class ArticleShowTest extends IntegrationTestCase
{
    public function __construct()
    {
        parent::__construct(ArticleShowAction::class);
    }

    public function testShowingArticleById()
    {
        $response = $this->request([], ['id' => 1]);
        $this->assertTrue($response['success']);
    }

    public function testShouldFailUserMustExist()
    {
        $response = $this->request([], ['id' => 999999]);
        $this->assertFalse($response['success']);
    }
}
