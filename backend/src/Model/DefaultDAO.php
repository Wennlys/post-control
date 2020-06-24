<?php

namespace Source\Model;

use Source\Core\Connection;

interface DefaultDAO
{
    public function __construct(Connection $dbInstance);
    public function find(Article $article): array;
    public function create(Article $article): array;
    public function update(Article $article): array;
    public function delete(Article $article): array;
}
