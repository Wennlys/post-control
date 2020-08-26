<?php

namespace Source\Model;

use PDO;
use PDOException;
use Source\Core\Connection;

class ArticleDAOImpl implements ArticleDAO
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        return ['id' => 1];
    }

    public function findById(string $id): array
    {
        return $this->db->query("SELECT title, slug, body, published FROM articles WHERE id = {$id}")->fetchAll() ?? [];
    }

    public function save(Article $article): string
    {
        $this->db->beginTransaction();

        try {
            $insertArticle = $this->db->prepare(
                'INSERT INTO articles (user_id, title, slug, body, published, created_at, updated_at)
                VALUES (:u, :t, :s, :b, :p, :ca, :ua)'
            );
            $insertArticle->bindValue(':u', $article->getUserId(), PDO::PARAM_INT);
            $insertArticle->bindValue(':t', $article->getTitle());
            $insertArticle->bindValue(':s', $article->getSlug());
            $insertArticle->bindValue(':b', $article->getBody());
            $insertArticle->bindValue(':p', $article->isPublished(), PDO::PARAM_BOOL);
            $insertArticle->bindValue(':ca', now());
            $insertArticle->bindValue(':u', now());
            $insertArticle->execute();
            $createdArticleId = $this->db->lastInsertId();

            foreach ($article->getTags() as $tag) {
                $tagId = $this->findTagIdByTagTitle($tag);
                if (0 === $tagId) {
                    $this->createTag($tag);
                    $tagId = $this->db->lastInsertId();
                }

                $this->db->query(
                    "INSERT INTO articles_tags (article_id, tag_id)
                    VALUES ({$createdArticleId}, {$tagId})"
                );
            }

            $this->db->commit();

            return $createdArticleId;
        } catch (PDOException $e) {
            $this->db->rollBack();

            throw $e;
        }
    }

    public function change(Article $article): bool
    {
        return true;
    }

    public function delete(Article $article): bool
    {
        return true;
    }

    private function findTagIdByTagTitle(string $title): int
    {
        $query = $this->db->prepare('SELECT id FROM tags WHERE title = ?');
        $query->bindParam(1, $title);
        $query->execute();

        return $query->fetchColumn(1);
    }

    private function createTag(string $title): bool
    {
        $query = $this->db->prepare('INSERT INTO tags (title, created_at, updated_at) VALUES (:t, :ca, :ua)');
        $query->bindValue(':t', $title);
        $query->bindValue(':ca', now());
        $query->bindValue(':ua', now());

        return $query->execute();
    }
}
