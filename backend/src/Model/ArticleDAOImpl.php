<?php

namespace Source\Model;

use PDO;
use PDOException;
use Source\Core\Connection;

class ArticleDAOImpl implements ArticleDAO
{
    private PDO $db;
    private string $currentDate;

    public function __construct()
    {
        $this->db = Connection::getInstance()->getConnection();
        $this->currentDate = now();
    }

    public function findAll(): array
    {
        return ['id' => 1];
    }

    /** @throws PDOException */
    public function findById(string $id): array
    {
        $data = $this->db->query(
            "SELECT title,
                    slug,
                    body,
                    published
            FROM articles WHERE id = {$id}"
        )->fetch(PDO::FETCH_ASSOC);

        if (false === $data) {
            throw new PDOException();
        }

        return $data;
    }

    /** @throws PDOException */
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
            $insertArticle->bindValue(':ca', $this->currentDate);
            $insertArticle->bindValue(':ua', $this->currentDate);
            $insertArticle->execute();
            $lastId = $this->db->lastInsertId();

            foreach ($article->getTags() as $tag) {
                $tagId = $this->findTagIdByTagTitle($tag);
                if (0 === $tagId) {
                    $this->createTag($tag);
                    $tagId = $this->db->lastInsertId();
                }

                $this->db->query(
                    "INSERT INTO articles_tags (article_id, tag_id)
                    VALUES ({$lastId}, {$tagId})"
                );
            }

            $this->db->commit();

            return $lastId;
        } catch (PDOException $e) {
            $this->db->rollBack();

            throw $e;
        }
    }

    /** @throws PDOException */
    public function change(Article $article): bool
    {
        $this->db->beginTransaction();

        try {
            $updates = [
                'user_id' => $article->getUserId(),
                'title' => $article->getTitle(),
                'slug' => $article->getSlug(),
                'body' => $article->getBody(),
                'published' => $article->isPublished(),
                'updated_at' => $this->currentDate,
            ];

            array_filter($updates, fn ($value) => null !== $value && '' !== $value);

            $params = [];
            $setStr = '';

            foreach ($updates as $key => $value) {
                if (isset($value) && 'id' !== $key) {
                    $setStr .= "{$key} = :{$key},";
                    $params[$key] = $value;
                }
            }
            $setStr = rtrim($setStr, ',');

            $params['id'] = $article->getId();

            $query = $this->db->prepare(
                "UPDATE articles SET {$setStr} WHERE id = :id"
            );

            $query->execute($params);

            $this->db->commit();

            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();

            throw $e;
        }
    }

    /** @throws PDOException */
    public function delete(Article $article): void
    {
        try {
            $id = $article->getId();
            $delete = $this->db->exec("DELETE FROM articles WHERE id = {$id}");
            if (0 === $delete) {
                throw new PDOException();
            }
        } catch (PDOException $e) {
            throw $e;
        }
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
        $query->bindValue(':ca', $this->currentDate);
        $query->bindValue(':ua', $this->currentDate);

        return $query->execute();
    }
}
