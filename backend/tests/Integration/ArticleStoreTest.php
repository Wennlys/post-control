<?php

declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ArticleStoreTest extends TestCase
{
    public Client $client;

    public function setUp(): void
    {
        $this->client = new Client(['base_uri' => ENV_URI]);
    }

   /**
    * @test
    */
    public function itShouldReturnTheStoredArticle()
    {
        $response = $this->client->request(
            'POST',
            '/articles',
            ['json' => ['title' => 'title', 'content' => 'content']]
        );
        $response = json_decode((string) $response->getBody());
        $this->assertObjectHasAttribute('id', $response);
    }
}