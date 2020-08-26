<?php

namespace Source\Model;

use PDO;
use Source\Core\Connection;

class UserDAOImpl implements UserDAO
{
    private PDO $database;

    public function __construct()
    {
        $this->database = Connection::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        return ['id' => 1];
    }

    public function findById(User $user): array
    {
        return ['id' => $user->getId()];
    }

    public function findByEmail(User $user): array
    {
        return ['email' => $user->getEmail()];
    }

    public function save(User $user): array
    {
        return [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ];
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
