<?php

declare(strict_types=1);

namespace Source\App\Services;

use PDOException;
use Source\Model\Article;
use Source\Model\ArticleDAO;

class ArticleService
{
    private ArticleDAO $dao;

    public function __construct(ArticleDAO $dao)
    {
        $this->dao = $dao;
    }

    /** @throws PDOException */
    public function index(): array
    {
        $data = $this->dao->findAll();

        return [
            $data,
        ];
    }

    /** @throws PDOException */
    public function show(Article $article): array
    {
        try {
            $id = (string) $article->getId();
            $data = $this->dao->findById($id);

            return [
                'success' => true,
                $data,
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }

    /** @throws PDOException */
    public function store(Article $article): array
    {
        try {
            $id = $this->dao->save($article);
            $data = $this->dao->findById($id);

            return [
                'success' => true,
                $data,
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }

    /** @throws PDOException */
    public function update(Article $article): array
    {
        try {
            $this->dao->change($article);
            $id = (string) $article->getId();
            $data = $this->dao->findById($id);

            return [
                'success' => true,
                $data,
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }

    /** @throws PDOException */
    public function destroy(Article $article): array
    {
        try {
            $this->dao->delete($article);

            return [
                'success' => true,
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                $e,
            ];
        }
    }
}
