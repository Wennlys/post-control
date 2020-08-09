<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Core\Connection;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;

class ArticleDestroyController
{
    private ArticleService $articleDao;

    public function __construct(Connection $dbInstance)
    {
        $this->service = new ArticleService($dbInstance);
    }

    public function destroy($r, array $args): JsonResponse
    {
        ['id' => $id] = $args;
        $response = $this->service->delete($id);

        return new JsonResponse(['ok' => $response]);
    }
}
