<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Model\Article;
use Source\Model\ArticleDAOImpl;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class ArticleStoreAction
{
    private ArticleService $service;

    public function __construct()
    {
        $dao = new ArticleDAOImpl();
        $this->service = new ArticleService($dao);
    }

    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        [
            'user_id' => $userId,
            'title' => $title,
            'body' => $body,
            'slug' => $slug,
            'published' => $published,
            'tags' => $tags
        ] = (array) json_decode((string) $request->getBody());

        $article = new Article();
        $article->setUserId($userId);
        $article->setTittle($title);
        $article->setBody($body);
        $article->setSlug($slug);
        $article->setPublished($published);
        $article->setTags($tags);

        $response = $this->service->store($article);

        return new JsonResponse($response);
    }
}
