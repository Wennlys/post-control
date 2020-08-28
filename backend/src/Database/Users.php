<?php

namespace Source\Database;

use PDO;
use PDOException;
use Source\Models\User;
use Source\Core\Connection;

class Users
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

    public function findByEmail(string $email): int
    {
        $query = $this->db->prepare('SELECT id FROM users WHERE email = ?');
        $query->bindParam(1, $email);

        return $query->fetchColumn(1);
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
