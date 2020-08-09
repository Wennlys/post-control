<?php

declare(strict_types=1);

namespace Source\App\Http;

use Source\Core\Connection;
use Source\Model\ArticleDAOImpl;
use Laminas\Diactoros\Response\JsonResponse;

class ArticleShowController
{
    private ArticleDAOImpl $articleDao;

    public function __construct(Connection $dbInstance)
    {
        $this->articleDao = new ArticleDAOImpl($dbInstance);
    }

    public function show($r, array $args): JsonResponse
    {
        ['id' => $id] = $args;
        $response = $this->articleDao->findById($id);

        return new JsonResponse($response);
    }
}
