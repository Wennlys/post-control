<?php

declare(strict_types=1);

namespace Source\App;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Source\Core\Connection;
use Source\Model\ArticleDAO;
use Source\Model\Article;

class ArticleUpdateController
{
    /** @var ArticleDAO $articleDao */
    private ArticleDAO $articleDao;

    /** @var Response $response */
    private Response $response;

    /**
     * AritcleUpdateController constructor.
     *
     * @param Connection $dbInstace
     * @param Response $response
     */
    public function __construct(Connection $dbInstace, Response $response)
    {
        $this->articleDao = new ArticleDAO($dbInstace);
        $this->response = $response;
    }

    public function update(ServerRequest $request): Response
    {
        ['title' => $title, 'content' => $content] = (array) json_decode((string) $request->getBody());
        $article = new Article();

        $article->setTittle($title);
        $article->setContent($content);

        $response = $this->articleDao->change($article);
        $this->response->getBody()->write(json_encode(['ok' => $response]));
        return $this->response->withStatus(200);
    }
}
