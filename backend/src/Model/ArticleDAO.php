<?php

namespace Source\Model;

use Source\Core\Connection;
use PDO;

interface ArticleDAO
{
    public function __construct(Connection $dbInstance);
    public function findAll(): array;
    public function getById($id);
    public function save(Article $article): array;
    public function change(Article $article): bool;
    public function delete($id): bool;
}
