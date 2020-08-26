<?php

declare(strict_types=1);

namespace Tests\Integration;

use Mocks\IntegrationTestCase;
use Source\App\Http\ArticleStoreAction;

class ArticleStoreTest extends IntegrationTestCase
{
    const CASES = [
        [
            'user_id' => 1,
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'slug' => 'test-post',
            'published' => true,
            'tags' => ['tag1', 'tag2', 'tag3'],
        ],
    ];

    public function __construct()
    {
        parent::__construct(ArticleStoreAction::class);
    }

    public function testArticleStoring(): void
    {
        $response = $this->request(self::CASES[0]);
        $this->assertTrue($response['success']);
    }

    /** @test */
    public function shouldFailsBecauseSlugsAreUnique(): void
    {
        $response = $this->request(self::CASES[0]);
        $this->assertFalse($response['success']);
    }
}
