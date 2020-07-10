<?php

declare(strict_types=1);

namespace Source\App;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Source\Model\ArticleDAOImpl;
use Source\Core\Connection;

class ArticleDestroyController
{
    /** @var ArticleDAOImpl $articleDao */
    private ArticleDAOImpl $articleDao;

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
        $this->articleDao = new ArticleDAOImpl($dbInstance);
    }

    /**
     * List all specified articles.
     *
     * @return Response
     */
    public function destroy(ServerRequest $request, array $args): Response
    {
        ['id' => $id] = $args;
        $response = $this->articleDao->delete($id);
        $this->response->getBody()->write(json_encode(['ok' => $response]));
        return $this->response->withStatus(200);
    }
}
