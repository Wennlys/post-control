<?php

declare(strict_types=1);

namespace Source\App\Services;

use Exception;
use Source\Model\Article;
use Source\Core\Connection;
use Source\Model\ArticleDAOImpl;

class ArticleService
{
    private ArticleDAOImpl $articleDao;

    public function __construct(Connection $connection)
    {
        $this->articleDao = new ArticleDAOImpl($connection);
    }

    /** @throws Exception */
    public function index(): array
    {
        try {
            $data = $this->articleDao->findAll();

            return [
                'success' => true,
                $data,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }

    /** @throws Exception */
    public function show(Article $article): array
    {
        try {
            $data = $this->articleDao->findById($article);

            return [
                'success' => true,
                $data,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }

    /** @throws Exception */
    public function store(Article $article): array
    {
        try {
            $data = $this->articleDao->save($article);

            return [
                'success' => true,
                $data,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }

    /** @throws Exception */
    public function update(Article $article): array
    {
        try {
            $data = $this->articleDao->change($article);

            return [
                'success' => true,
                $data,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }

    /** @throws Exception */
    public function destroy(Article $article): array
    {
        try {
            $data = $this->articleDao->delete($article);

            return [
                'success' => true,
                $data,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }
}
