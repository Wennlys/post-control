<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Core\Connection;
use Source\Model\ArticleDAOImpl;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;

class ArticleDestroyController
{
    private ArticleService $service;

    public function __construct(Connection $dbInstance)
    {
        $dao = new ArticleDAOImpl($dbInstance);
        $this->service = new ArticleService($dao);
    }

    public function destroy($r, array $args): JsonResponse
    {
        ['id' => $id] = $args;
        $response = $this->service->destroy($id);

        return new JsonResponse(['ok' => $response]);
    }
}
