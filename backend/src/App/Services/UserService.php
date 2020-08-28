<?php

declare(strict_types=1);

namespace Source\App\Services;

use PDOException;
use Source\Model\User;
use Source\Model\UserDAO;

class UserService extends Service
{
    private UserDAO $userDao;

    public function __construct(UserDAO $dao)
    {
        $this->userDao = $dao;
    }

    /** @throws PDOException */
    public function index(): array
    {
        try {
            $data = $this->userDao->findAll();

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
            $data = $this->userDao->findById($id);

            return $this->handleSuccess($data);
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }

    /** @throws PDOException */
    public function store(User $user): array
    {
        try {
            $id = $this->userDao->save($user);
            $data = $this->userDao->findById($id);

            return $this->handleSuccess($data);
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }

    /** @throws PDOException */
    public function update(User $user): array
    {
        try {
            $this->userDao->change($user);

            return $this->handleSuccess();
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }

    /** @throws PDOException */
    public function destroy(User $user): array
    {
        try {
            $this->userDao->delete($user);

            return $this->handleSuccess();
        } catch (PDOException $e) {
            return $this->handleException($e);
        }
    }
}
