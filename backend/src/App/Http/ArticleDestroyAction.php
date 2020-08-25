<?php

declare(strict_types=1);

namespace Source\App\Http;

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
        $response = $this->service->destroy($id);

        return new JsonResponse(['ok' => $response]);
    }
}
