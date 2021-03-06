<?php

declare(strict_types=1);

namespace Source\Models;

class Article
{
    private ?int $id = null;
    private ?int $userId = null;
    private ?string $title = null;
    private ?string $body = null;
    private ?string $slug = null;
    private bool $published = false;
    private array $tags = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $id): void
    {
        $this->userId = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTittle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): void
    {
        $this->published = $published ?? false;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags = []): void
    {
        $this->tags = $tags;
    }
}
