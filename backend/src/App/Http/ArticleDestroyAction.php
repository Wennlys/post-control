<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Model\Article;
use Source\Model\ArticleDAOImpl;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;

class ArticleDestroyAction
{
    private ArticleService $service;

    public function __construct()
    {
        $dao = new ArticleDAOImpl();
        $this->service = new ArticleService($dao);
    }

    public function __invoke($r, array $args): JsonResponse
    {
        ['id' => $id] = $args;

        $article = new Article();
        $article->setId($id);

        $response = $this->service->destroy($article);

        return new JsonResponse($response);
    }
}
