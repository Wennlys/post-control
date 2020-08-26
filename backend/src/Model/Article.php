<?php

declare(strict_types=1);

namespace Source\Model;

class Article
{
    private int $userId;

    private string $title;

    private string $body;

    private bool $published = false;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $id): void
    {
        $this->userId = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTittle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): void
    {
        $this->published = $published ?? false;
    }
}
