<?php

declare(strict_types=1);

namespace Source\App\Services;

use PDOException;
use Source\Models\User;
use Source\Database\Users;

class UserService extends Service
{
    private Users $db;

    public function __construct(Users $db)
    {
        $this->db = $db;
    }

    /** @throws PDOException */
    public function index(): array
    {
        try {
            $data = $this->db->findAll();

            return $this->handleSuccess($data);
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }

    /** @throws PDOException */
    public function show(User $user): array
    {
        try {
            $id = (string) $user->getId();
            $data = $this->db->findById($id);

            return $this->handleSuccess($data);
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }

    /** @throws PDOException */
    public function store(User $user): array
    {
        try {
            $email = $user->getEmail();
            if (false === $this->db->findByEmail($email)) {
                return $this->handleException(new PDOException('Emails are unique'));
            }

            $id = $this->db->save($user);
            $data = $this->db->findById($id);

            return $this->handleSuccess($data);
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }

    /** @throws PDOException */
    public function update(User $user): array
    {
        try {
            $this->db->change($user);

            return $this->handleSuccess();
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }

    /** @throws PDOException */
    public function destroy(User $user): array
    {
        try {
            $this->db->delete($user);

            return $this->handleSuccess();
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }
}
