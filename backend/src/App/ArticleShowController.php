<?php

declare(strict_types=1);

namespace Source\App;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Source\Core\Connection;
use Source\Model\ArticleDAOImpl;

class ArticleShowController
{
    /** @var ArticleDAOImpl $articleDao */
    private ArticleDAOImpl $articleDao;

    /** @var Response $response */
    private Response $response;

    /**
     * ArticleShowController constructor.
     * @param Connection $dbInstance
     * @param Response $response
     */
    public function __construct(Connection $dbInstance, Response $response)
    {
        $this->response = $response;
        $this->articleDao = new ArticleDAOImpl($dbInstance);
    }

    public function show(ServerRequest $request, array $args): Response
    {
        ['id' => $id] = $args;
        $response = $this->articleDao->getById($id);
        $this->response->getBody()->write(json_encode($response));
        return $this->response->withStatus(200);
    }
}
