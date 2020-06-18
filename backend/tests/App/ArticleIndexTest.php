<?php

declare(strict_types=1);

namespace CMS\Tests\App;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ArticleIndexTest extends TestCase
{
    public Client $client;

    public function setUp(): void
    {
        $this->client = new Client(["base_uri" => ENV_URI]);
    }

   /**
    * @test
    */
    public function itShouldReturnAllStoredArticles(): void
    {
        $response = $this->client->request("GET", "/articles");
        $response = (array) json_decode((string) $response->getBody());
        $this->assertArrayHasKey('id', $response);
    }
}
