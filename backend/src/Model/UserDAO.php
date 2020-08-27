<?php

namespace Source\Model;

interface UserDAO
{
    public function findAll(): array;

    public function findByEmail(User $user): array;

    public function findById(string $id): array;

    public function save(User $user): string;

    public function change(User $user): bool;

    public function delete(User $user): bool;
}
