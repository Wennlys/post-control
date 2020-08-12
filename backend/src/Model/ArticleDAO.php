<?php

namespace Source\Model;

use Source\Core\Connection;

interface ArticleDAO
{
    public function __construct(Connection $dbInstance);

    public function findAll(): array;

    public function findById(Article $artcile): array;

    public function save(Article $article): array;

    public function change(Article $article): bool;

    public function delete(Article $article): bool;
}
