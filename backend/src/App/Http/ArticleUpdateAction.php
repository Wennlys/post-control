<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Model\Article;
use Source\Model\ArticleDAOImpl;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class ArticleUpdateAction
{
    private ArticleService $service;

    public function __construct()
    {
        $dao = new ArticleDAOImpl();
        $this->service = new ArticleService($dao);
    }

    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        ['title' => $title, 'body' => $body] = (array) json_decode((string) $request->getBody());
        $article = new Article();

        $article->setTittle($title);
        $article->setBody($body);

        $response = $this->service->update($article);

        return new JsonResponse($response);
    }
}
