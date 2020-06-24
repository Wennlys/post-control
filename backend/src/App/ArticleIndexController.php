<?php

declare(strict_types=1);

namespace Source\App;

use Laminas\Diactoros\Response;
use Source\Core\Connection;
use Source\Model\ArticleDAO;

class ArticleIndexController
{
    /** @var ArticleDAO $articleDao */
    private ArticleDAO $articleDao;

    /** @var Response $response */
    private Response $response;

    /**
     * ArticleIndexController constructor.
     *
     * @param Connection $dbInstance
     * @param ResponseInterface $response
     */
    public function __construct(Connection $dbInstance, Response $response)
    {
        $this->response = $response;
        $this->articleDao = new ArticleDAO($dbInstance);
    }

    /**
     * List all specified articles.
     *
     * @return Response
     */
    public function index(): Response
    {
        $response = $this->articleDao->findAll();
        $this->response->getBody()->write(json_encode($response));
        return $this->response->withStatus(200);
    }
}
