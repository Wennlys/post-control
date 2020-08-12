<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Model\Article;
use Source\Core\Connection;
use Source\Model\ArticleDAOImpl;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class ArticleStoreController
{
    private ArticleService $service;

    public function __construct(Connection $dbInstance)
    {
        $dao = new ArticleDAOImpl($dbInstance);
        $this->service = new ArticleService($dao);
    }

    public function store(ServerRequestInterface $request): JsonResponse
    {
        ['title' => $title, 'content' => $content] = (array) json_decode((string) $request->getBody());
        $article = new Article();

        $article->setTittle($title);
        $article->setContent($content);

        $response = $this->service->store($article);

        return new JsonResponse($response);
    }
}
