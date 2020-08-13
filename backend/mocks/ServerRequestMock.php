<?php

namespace Mocks;

use Laminas\Diactoros\ServerRequest;

class ServerRequestMock extends ServerRequest
{
    public function __construct()
    {
        parent::__construct([], [], null, null, 'php://memory');
    }
}
