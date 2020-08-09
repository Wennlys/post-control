<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Core\Connection;
use Source\Model\ArticleDAOImpl;
use Laminas\Diactoros\Response\JsonResponse;

class ArticleIndexController
{
    private ArticleDAOImpl $articleDao;

    public function __construct(Connection $dbInstance)
    {
        $this->articleDao = new ArticleDAOImpl($dbInstance);
    }

    public function index(): JsonResponse
    {
        return new JsonResponse($this->articleDao->findAll());
    }
}
