<?php

declare(strict_types=1);

namespace App\Post\Application\Admin\Command;

use App\Post\Domain\Category;
use App\Post\Domain\Post;
use App\Post\Domain\PostRepositoryInterface;
use App\Post\Domain\PublicationDate;
use DateTimeImmutable;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler(bus: 'command_bus')]
class CreatePostCommandHandler
{
    public function __construct(private PostRepositoryInterface $repository)
    {
    }

    public function __invoke(CreatePostCommand $command): void
    {
        $this->repository->store(Post::create(
            id: Uuid::v4(),
            title: $command->title,
            category: Category::from($command->category),
            body: $command->body,
            publicationDate: PublicationDate::create(
                $command->publishedAt?->from ? $this->objectMapper->toObject($command->publishedAt->from, DateTimeImmutable::class) : null,
                $command->publishedAt?->to ? $this->objectMapper->toObject($command->publishedAt->to, DateTimeImmutable::class) : null,
            ),
        ));
    }
}
