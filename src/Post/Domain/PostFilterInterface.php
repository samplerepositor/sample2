<?php

declare(strict_types=1);

namespace App\Post\Domain;

interface PostFilterInterface
{
    /**
     * @return Post[]
     */
    public function getResults(): array;

    public function setTitle(string $title = null): self;

    public function setCategories(array $categories = null): self;

    public function setPublicationDate(array $publicationDate = []): self;
}
