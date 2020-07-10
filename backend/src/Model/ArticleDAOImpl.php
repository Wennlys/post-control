<?php

namespace Source\Model;

use Source\Core\Connection;
use Source\Model\ArticleDAO;
use PDO;

class ArticleDAOImpl implements ArticleDAO
{
    private PDO $database;

    public function __construct(Connection $dbInstance)
    {
        $this->database = $dbInstance->getConnection();
    }

    public function findAll(): array
    {
        return ['id' => 1];
    }

    public function getById($id): array
    {
        return ['id' => $id];
    }

    public function save(Article $article): array
    {
        return [
            'id' => random_int(1, 100),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ];
    }

    public function change(Article $article): bool
    {
        return true;
    }

    public function delete($id): bool
    {
        return true;
    }
}
