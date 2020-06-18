<?php

declare(strict_types=1);

require_once dirname(__DIR__) . "/backend/vendor/autoload.php";

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;
use League\Route\Router;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\Diactoros\ServerRequestFactory;

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$router = new Router();

// map a route
$router->map('GET', '/articles', function (ServerRequestInterface $request): ResponseInterface {
    $response = new Response();
    $response->getBody()->write(json_encode(['id' => 1]));
    return $response;
});

$response = $router->dispatch($request);

// send the response to the browser
(new SapiEmitter())->emit($response);
