<?php

declare(strict_types=1);

namespace Mocks;

use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    protected string $actionClass;

    protected function __construct(string $class)
    {
        parent::__construct();
        $this->actionClass = $class;
    }

    protected function request(array $array = [], array $args = []): array
    {
        $json = json_encode($array);
        $request = new ServerRequestMock();

        $request->getBody()->write($json);
        $response = (new $this->actionClass())($request, $args);

        return json_decode((string) $response->getBody(), true);
    }
}
