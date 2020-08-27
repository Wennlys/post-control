<?php

declare(strict_types=1);

namespace Tests\Integration;

use Mocks\IntegrationTestCase;
use Source\App\Http\UserStoreAction;

class UserStoreTest extends IntegrationTestCase
{
    private const CASES = [
        [
            'name' => 'User1',
            'email' => 'user1@mail.com',
            'password' => '1234',
        ],
    ];

    public function __construct()
    {
        parent::__construct(UserStoreAction::class);
    }

    public function testUserStoring()
    {
        $response = $this->request(self::CASES[0]);
        $this->assertTrue($response['success']);
    }

    public function testShouldFailSlugsAreUnique(): void
    {
        $response = $this->request(self::CASES[0]);
        $this->assertFalse($response['success']);
    }
}
