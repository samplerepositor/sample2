<?php

declare(strict_types=1);

namespace App\Post\Domain\Event;

use App\Post\Domain\Category;
use App\Post\Domain\PublicationDate;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

class PostWasCreated extends AbstractPostEvent
{
    public function __construct(
        Uuid $id,
        string $title,
        Category $category,
        string $body,
        private PublicationDate $publicationDate,
        DateTimeImmutable $createdAt = null,
        int $version = null
    ) {
        parent::__construct($id, $title, $category, $body, $createdAt, $version);
    }

    public function getPublicationDate(): PublicationDate
    {
        return $this->publicationDate;
    }
}
