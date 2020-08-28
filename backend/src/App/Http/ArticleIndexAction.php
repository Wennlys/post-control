<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Database\Articles;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;

class ArticleIndexAction
{
    private ArticleService $service;

    public function __construct()
    {
        $database = new Articles();
        $this->service = new ArticleService($database);
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse($this->service->index());
    }
}
