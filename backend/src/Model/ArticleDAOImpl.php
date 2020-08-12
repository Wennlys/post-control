<?php

namespace Source\Model;

use PDO;
use Source\Core\Connection;

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

    public function findById(Article $artcile): array
    {
        return ['id' => $artcile->getId()];
    }

    public function save(Article $article): array
    {
        return [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
        ];
    }

    public function change(Article $article): bool
    {
        return true;
    }

    public function delete(Article $article): bool
    {
        return true;
    }
}
