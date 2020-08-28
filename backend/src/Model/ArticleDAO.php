<?php

namespace Source\Model;

interface ArticleDAO
{
    public function findAll(): array;

    public function findById(string $id): array;

    public function save(Article $article): string;

    public function change(Article $article): bool;

    public function delete(Article $article): void;
}
