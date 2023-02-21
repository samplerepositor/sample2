<?php

declare(strict_types=1);

namespace App\Post\Application\Admin\Command;

use App\Post\Domain\Category;
use App\Shared\Application\Structure\DateRange;
use Symfony\Component\Validator\Constraints as Assert;

class CreatePostCommand
{
    public function __construct(
        #[Assert\NotBlank, Assert\Length(max: 90)]
        public string $title,
        #[Assert\NotBlank, Assert\Length(max: 255), Assert\Choice(callback: [Category::class, 'values'])]
        public string $category,
        #[Assert\NotBlank]
        public string $body,
        #[Assert\Valid, RequestParamModifier(name: 'published_at', suffixes: ['from', 'to'])]
        public ?DateRange $publishedAt,
    ) {
    }
}
