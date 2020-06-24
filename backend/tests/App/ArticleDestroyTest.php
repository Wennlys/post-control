<?php

declare(strict_types=1);

namespace Tests\App;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ArticleDestroyTest extends TestCase
{
    public Client $client;

    public function setUp(): void
    {
        $this->client = new Client(['base_uri' => ENV_URI]);
    }

   /**
    * @test
    */
    public function itShouldReturnTrue()
    {
        $response = $this->client->request('DELETE', '/articles/1');
        $response = (array) json_decode((string) $response->getBody());

        $this->assertEquals($response, ['ok' => true]);
    }
}
