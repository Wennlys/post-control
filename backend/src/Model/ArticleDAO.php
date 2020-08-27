<?php

namespace Source\Model;

interface ArticleDAO
{
    public function findAll(): array;

    public function findById(string $id): array;

    public function save(Article $article);

    public function change(Article $article): bool;

    public function delete(Article $article): bool;
}
