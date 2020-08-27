<?php

declare(strict_types=1);

namespace Tests\Integration;

use Mocks\IntegrationTestCase;
use Source\App\Http\ArticleStoreAction;

class ArticleStoreTest extends IntegrationTestCase
{
    private const CASES = [
        [
            'user_id' => 1,
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'slug' => 'test-post',
            'published' => true,
            'tags' => ['tag1', 'tag2', 'tag3'],
        ],
        [
            'user_id' => 999999999,
            'title' => '',
            'body' => '',
            'slug' => '',
            'published' => true,
            'tags' => [],
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

    public function testShouldFailEmailsAreUnique(): void
    {
        $response = $this->request(self::CASES[0]);
        $this->assertFalse($response['success']);
    }

    public function testShouldFailUserMustExist(): void
    {
        $response = $this->request(self::CASES[1]);
        $this->assertSame('User not found.', $response['message']);
    }
}
