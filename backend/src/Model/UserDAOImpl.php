<?php

namespace Source\Model;

use PDO;
use PDOException;
use Source\Core\Connection;

class UserDAOImpl implements UserDAO
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

    public function findById(string $id): array
    {
        $data = $this->db->query(
            "SELECT id,
                    name,
                    email
            FROM users WHERE id = {$id}"
        )->fetch(PDO::FETCH_ASSOC);

        if (false === $data) {
            throw new PDOException();
        }

        return $data;
    }

    public function findByEmail(User $user): array
    {
        return ['email' => $user->getEmail()];
    }

    public function save(User $user): string
    {
        try {
            $query = $this->db->prepare(
                'INSERT INTO users (name, email, password, created_at, updated_at)
                VALUES (:n, :e, :p, :ca, :ua)'
            );
            $query->bindValue(':n', $user->getName());
            $query->bindValue(':e', $user->getEmail());
            $query->bindValue(':p', $user->getPassword());
            $query->bindValue(':ca', $this->currentDate);
            $query->bindValue(':ua', $this->currentDate);
            $query->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function change(User $user): bool
    {
        return true;
    }

    public function delete(User $user): bool
    {
        return true;
    }
}
