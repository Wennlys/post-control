<?php

declare(strict_types=1);

require_once dirname(__DIR__) . "/backend/vendor/autoload.php";

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ResponseFactory;
use League\Container\Container;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Source\App\ArticleIndexController;
use Source\Core\Connection;
use Source\Model\ArticleDAO;

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$responseFactory = new ResponseFactory();
$strategy = new JsonStrategy($responseFactory);

$container = new Container();
$router = new Router();

$response = Response::class;
$dbConnection = Connection::class;
$articleDao = ArticleDAO::class;

$dbInstance = Connection::getInstance();

$container->add($response);
$container->add($dbConnection);

$container->add(ArticleIndexController::class)
    ->addArgument($dbInstance)
    ->addArgument($articleDao)
    ->addArgument($response);

$strategy->setContainer($container);
$router->setStrategy($strategy);

// map a route
$router->map('GET', '/articles', 'Source\App\ArticleIndexController::index');

$response = $router->dispatch($request);

// send the response to the browser
(new SapiEmitter())->emit($response);
