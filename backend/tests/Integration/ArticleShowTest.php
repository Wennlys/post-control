<?php

declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ArticleShowTest extends TestCase
{
    public Client $client;

    public function setUp(): void
    {
        $this->client = new Client(['base_uri' => ENV_URI]);
    }

    /**
     * @test
     */
    public function itShouldReturnTheSpecifiedArticleById()
    {
        $response = $this->client->request('GET', '/articles/show/1');
        $response = json_decode((string) $response->getBody());
        $this->assertObjectHasAttribute('id', $response);
    }
}
