<?php

declare(strict_types=1);

namespace App\Post\Domain;

use App\Post\Domain\Event\PostWasCreated;
use App\Shared\Domain\EventingTrait;
use App\Shared\Domain\AbstractAggregateRoot;
use App\Shared\Domain\AbstractAggregateRootEvent;
use App\Shared\Domain\DateTimeProvider;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

class Post extends AbstractAggregateRoot
{
    use EventingTrait;

    private Uuid $id;

    private string $title;

    private Category $category;

    private string $body;

    private PublicationDate $publicationDate;

    private DateTimeImmutable $createdAt;

    private ?DateTimeImmutable $updatedAt;

    protected function __construct(AbstractAggregateRootEvent $event = null)
    {
        parent::__construct($event);
        $this->updatedAt = null;
        $this->createdAt = DateTimeProvider::current();
    }

    public static function create(
        Uuid $id,
        string $title,
        Category $category,
        string $body,
        PublicationDate $publicationDate,
    ): self {
        return new self(new PostWasCreated($id, $title, $category, $body, $publicationDate));
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

    public function getPublicationDate(): PublicationDate
    {
        return $this->publicationDate;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    protected function whenPostWasCreated(PostWasCreated $event): void
    {
        $this->id = $event->getId();
        $this->title = $event->getTitle();
        $this->category = $event->getCategory();
        $this->body = $event->getBody();
        $this->publicationDate = $event->getPublicationDate();
    }
}
