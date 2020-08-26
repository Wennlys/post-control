<?php

namespace Source\Model;

use Source\Core\Connection;
use PDO;

class ArticleDAOImpl implements ArticleDAO
{
    private PDO $database;

    public function __construct()
    {
        $this->database = Connection::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        return ['id' => 1];
    }

    public function findById(Article $article): array
    {
        return ['id' => $article->getUserId()];
    }

    public function save(Article $article): array
    {
        return [
            'title' => $article->getTitle(),
            'body' => $article->getBody(),
            'published' => $article->isPublished(),
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
