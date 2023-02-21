<?php

declare(strict_types=1);

namespace App\Post\Domain;

use Symfony\Component\Uid\Uuid;

interface PostRepositoryInterface
{
    public function store(Post $post): void;

    public function findOne(Uuid $id): Post;

    public function createPostFilters(): PostFilterInterface;

    /**
     * @return Post[]
     */
    public function findActivePosts(): array;
}
