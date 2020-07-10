<?php

declare(strict_types=1);

namespace Source\App;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Source\Model\ArticleDAOImpl;
use Source\Core\Connection;
use Source\Model\Article;

class ArticleStoreController
{
    /** @var ArticleDAOImpl $articleDao */
    private ArticleDAOImpl $articleDao;

    /** @var Response $response */
    private Response $response;

    /**
     * ArticleStoreController constructor.
     * @param Connection $dbInstance
     * @param Response $response
     */
    public function __construct(Connection $dbInstance, Response $response)
    {
        $this->articleDao = new ArticleDAOImpl($dbInstance);
        $this->response = $response;
    }

    public function store(ServerRequest $request): Response
    {
        ['title' => $title, 'content' => $content] = (array) json_decode((string) $request->getBody());
        $article = new Article();

        $article->setTittle($title);
        $article->setContent($content);

        $response = $this->articleDao->save($article);

        $this->response->getBody()->write(json_encode($response));
        return $this->response->withStatus(200);
    }
}
