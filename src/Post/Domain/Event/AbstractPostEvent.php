<?php

declare(strict_types=1);

namespace App\Post\Domain\Event;

use App\Post\Domain\Category;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

abstract class AbstractPostEvent extends AbstractAggregateRootEvent
{
    public function __construct(
        private Uuid $id,
        private string $title,
        private Category $category,
        private string $body,
        DateTimeImmutable $createdAt = null,
        int $version = null
    ) {
        parent::__construct($createdAt, $version);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
