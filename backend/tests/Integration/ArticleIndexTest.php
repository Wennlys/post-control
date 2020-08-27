<?php

declare(strict_types=1);

namespace Tests\Integration;

use Mocks\IntegrationTestCase;
use Source\App\Http\ArticleIndexAction;

class ArticleIndexTest extends IntegrationTestCase
{
    public function __construct()
    {
        parent::__construct(ArticleIndexAction::class);
    }

    public function testShowingArticleById()
    {
        $response = $this->request();
        $this->assertIsArray($response);
    }
}
