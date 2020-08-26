<?php

declare(strict_types=1);

namespace Source\Model;

use LengthException;
use PharIo\Manifest\InvalidEmailException;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if (\strlen($name) <= 40 || \strlen($name) >= 4) {
            $this->name = $name;
        } else {
            throw new LengthException();
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            if (\strlen($email) > 10) {
                $this->email = $email;
            } else {
                throw new LengthException();
            }
        } else {
            throw new InvalidEmailException();
        }
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        if (\strlen($password) <= 40 || \strlen($password) >= 4) {
            $this->password = $password;
        } else {
            throw new LengthException();
        }
    }
}
