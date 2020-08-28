<?php

declare(strict_types=1);

namespace Source\Models;

class User
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        if (\strlen($password) <= 40 || \strlen($password) >= 4) {
            $this->password = $password;
        }
    }
}
