<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/backend/vendor/autoload.php';

use League\Route\Router;
use Source\Core\MySqlConnection;
use Laminas\Diactoros\ResponseFactory;
use League\Route\Strategy\JsonStrategy;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

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

$dbInstace = MySqlConnection::getInstance();

$router->map(
    'GET',
    '/articles',
    [new Source\App\Http\ArticleIndexController($dbInstace), 'index']
);

$router->map(
    'GET',
    '/articles/{id:number}',
    [new Source\App\Http\ArticleShowController($dbInstace), 'show']
);

$router->map(
    'POST',
    '/articles',
    [new Source\App\Http\ArticleStoreController($dbInstace), 'store']
);

$router->map(
    'PUT',
    '/articles',
    [new Source\App\Http\ArticleUpdateController($dbInstace), 'update']
);

$router->map(
    'DELETE',
    '/articles/{id:number}',
    [new Source\App\Http\ArticleDestroyController($dbInstace), 'destroy']
);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);
