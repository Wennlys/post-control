<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Model\Article;
use Source\Core\Connection;
use Source\Model\ArticleDAOImpl;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class ArticleStoreController
{
    private ArticleDAOImpl $articleDao;

    public function __construct(Connection $dbInstance)
    {
        $this->articleDao = new ArticleDAOImpl($dbInstance);
    }

    public function store(ServerRequestInterface $request): JsonResponse
    {
        ['title' => $title, 'content' => $content] = (array) json_decode((string) $request->getBody());
        $article = new Article();

        $article->setTittle($title);
        $article->setContent($content);

        $response = $this->articleDao->save($article);

        return new JsonResponse($response);
    }
}
