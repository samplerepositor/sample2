<?php

declare(strict_types=1);

namespace App\Post\Application\Api\View;

use App\Post\Domain\Post;

class PostListElementView
{
    private function __construct(
        public readonly string $category,
        public readonly string $title,
        public readonly string $body,
    ) {
    }

    public static function create(Post $post): self
    {
        return new self(
            $post->getCategory()->value,
            $post->getTitle(),
            $post->getBody(),
        );
    }
}
