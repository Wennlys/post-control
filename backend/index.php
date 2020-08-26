<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/backend/vendor/autoload.php';

use Dotenv\Dotenv;
use League\Route\Router;
use Laminas\Diactoros\ResponseFactory;
use League\Route\Strategy\JsonStrategy;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

(Dotenv::createImmutable(__DIR__))->load();

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

$router->map(
    'GET',
    '/articles',
    Source\App\Http\ArticleIndexAction::class
);

$router->map(
    'GET',
    '/articles/{id:number}',
    Source\App\Http\ArticleShowAction::class
);

$router->map(
    'POST',
    '/articles',
    Source\App\Http\ArticleStoreAction::class
);

$router->map(
    'PUT',
    '/articles',
    Source\App\Http\ArticleUpdateAction::class
);

$router->map(
    'DELETE',
    '/articles/{id:number}',
    Source\App\Http\ArticleDestroyAction::class
);

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);
