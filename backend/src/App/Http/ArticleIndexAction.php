<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Model\ArticleDAOImpl;
use Source\App\Services\ArticleService;
use Laminas\Diactoros\Response\JsonResponse;

class ArticleIndexAction
{
    private ArticleService $service;

    public function __construct()
    {
        $dao = new ArticleDAOImpl();
        $this->service = new ArticleService($dao);
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse($this->service->index());
    }
}
