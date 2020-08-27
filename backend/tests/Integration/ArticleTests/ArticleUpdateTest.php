<?php

declare(strict_types=1);

namespace Tests\Integration;

use Mocks\IntegrationTestCase;
use Source\App\Http\ArticleUpdateAction;

class ArticleUpdateTest extends IntegrationTestCase
{
    private const CASES = [
        [
            'id' => 1,
            'user_id' => 1,
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'slug' => 'test-post1',
            'published' => true,
            'tags' => ['tag1', 'tag2', 'tag3'],
        ],
        [
            'id' => 1,
            'user_id' => 999999999,
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'slug' => 'test-post2',
            'published' => true,
            'tags' => ['tag1', 'tag2', 'tag3'],
        ],
        [
            'id' => 999999,
            'user_id' => 1,
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'slug' => 'test-post3',
            'published' => true,
            'tags' => ['tag1', 'tag2', 'tag3'],
        ],
        [
            'id' => 1,
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
        parent::__construct(ArticleUpdateAction::class);
    }

    public function testUserUpdating()
    {
        $response = $this->request(self::CASES[0]);
        $this->assertTrue($response['success']);
    }

    /** @test */
    public function userIdMustMatch()
    {
        $response = $this->request(self::CASES[1]);
        $this->assertSame('User not found.', $response['message']);
    }

    /** @test */
    public function articleIdMustMatch()
    {
        $response = $this->request(self::CASES[2]);
        $this->assertFalse($response['success']);
    }

    /** @test */
    public function slugMustBeUnique()
    {
        $response = $this->request(self::CASES[3]);
        $this->assertFalse($response['success']);
    }
}
