<?php

namespace Source\Model;

interface ArticleDAO
{
    public function findAll(): array;

    public function findById(Article $article): array;

    public function save(Article $article): array;

    public function change(Article $article): bool;

    public function delete(Article $article): bool;
}
