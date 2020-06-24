<?php

declare(strict_types=1);

namespace Tests\App;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ArticleUpdateTest extends TestCase
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
        $response = $this->client->request(
            'PUT',
            '/articles',
            ['json' => [
                'id' => 1,
                'title' => 'title',
                'content' => 'content'
                ]
            ]
        );
        $response = (array) json_decode((string) $response->getBody());

        $this->assertEquals($response, ['ok' => true]);
    }
}
