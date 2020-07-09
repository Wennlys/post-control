<?php

namespace Source\Model;

use Source\Core\Connection;
use PDO;

class ArticleDAO
{
    /** @var PDO $database */
    private PDO $database;

    public function __construct(Connection $dbInstance)
    {
        $this->database = $dbInstance->getConnection();
    }

    public function findAll()
    {
        return ['id' => 1];
    }

    public function getById($id)
    {
        return ['id' => $id];
    }

    public function save(Article $article)
    {
        return [
            // 'id' => random_int(1, 100),
            'id' => $a,
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
