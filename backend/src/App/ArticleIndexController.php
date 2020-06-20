<?php

declare(strict_types=1);

namespace Source\App;

use Source\Core\Connection;
use Laminas\Diactoros\Response;
use Source\Model\ArticleDAO;

class ArticleIndexController
{
    /** @var ArticleDAO $articleDao */
    private ArticleDAO $articleDao;

    /** @var Response $response */
    private Response $response;

    /** @var Connection $dbConnection */
    private Connection $dbConnection;

    /**
     * ArticleIndexController contructor.
     *
     * @param Response $response
     */
    public function __construct(Connection $dbConnection, ArticleDAO $articleDao, Response $response)
    {
        $this->dbConnection = $dbConnection;
        $this->articleDao = $articleDao;
        $this->response = $response;
    }

    /**
     * List all specified articles.
     *
     * @return void
     */
    public function index(): Response
    {
        $a = $this->articleDao;
        $response = [];
        $this->response->getBody()->write(json_encode($response));
        return $this->response->withStatus(200);
    }
}
