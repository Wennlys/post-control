<?php

declare(strict_types=1);

require_once dirname(__DIR__) . "/backend/vendor/autoload.php";

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ResponseFactory;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Source\Core\Connection;

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$responseFactory = new ResponseFactory();
$strategy = new JsonStrategy($responseFactory);
$router = new Router();

$response = new Response();
$dbInstace = Connection::getInstance();

$router->map(
    'GET',
    '/articles',
    [new Source\App\ArticleIndexController($dbInstace, $response), 'index']
);

$router->map(
    'GET',
    '/articles/show/{id:number}',
    [new Source\App\ArticleShowController($dbInstace, $response), 'show']
);

$router->map(
    'POST',
    '/articles',
    [new Source\App\ArticleStoreController($dbInstace, $response), 'store']
);

$router->map(
    'PUT',
    '/articles',
    [new Source\App\ArticleUpdateController($dbInstace, $response), 'update']
);

$router->map(
    'DELETE',
    '/articles/{id:number}',
    [new Source\App\ArticleDestroyController($dbInstace, $response), 'destroy']
);

$response = $router->dispatch($request);

// send the response to the browser
(new SapiEmitter())->emit($response);
