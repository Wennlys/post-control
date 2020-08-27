<?php

namespace Source\App\Services;

use PDOException;
use Source\Model\User;
use Source\Model\UserDAO;

class UserService
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
    public function show(User $user): array
    {
        try {
            if ($user->getEmail()) {
                $data = $this->userDao->findByEmail($user);
            } else {
                $id = (string) $user->getId();
                $data = $this->userDao->findById($id);
            }

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
    public function store(User $user): array
    {
        try {
            $id = $this->userDao->save($user);
            $data = $this->userDao->findById($id);

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
    public function update(User $user): array
    {
        try {
            $data = $this->userDao->change($user);

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
    public function destroy(User $user): array
    {
        try {
            $data = $this->userDao->delete($user);

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
}
