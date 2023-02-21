<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Persistence\Doctrine\Repository\Post;

use App\Post\Domain\Post;
use App\Post\Domain\PostFilterInterface;
use App\Shared\Infrastructure\Persistence\Doctrine\Repository\AbstractFilters;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class PostFilters extends AbstractFilters implements PostFilterInterface
{
    public function __construct(
        EntityManagerInterface $entityManager,
        private ?string $title = null,
        private ?array $categories = null,
        private ?array $publicationDate = [],
    ) {
        parent::__construct($entityManager);
    }

    public function getQuery(): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder(Post::class, 'p');
        $this->applyParameterFilter($queryBuilder, 'p.title', $this->title);

        if (null !== $this->categories) {
            $this->applyArrayParameterFilter($queryBuilder, 'p.category', $this->prepareCategoriesValues());
        }

        $this->applyParameterFilter(
            queryBuilder: $queryBuilder,
            param: 'p.publicationDate.from',
            value: $this->publicationDate['from'] ?? null,
            operator: '>=',
            parameterSuffix: 'from',
        );
        $this->applyParameterFilter(
            queryBuilder: $queryBuilder,
            param: 'p.publicationDate.to',
            value: $this->publicationDate['to'] ?? null,
            operator: '<=',
            parameterSuffix: 'to',
        );
        $this->addSortQuery($queryBuilder);

        return $queryBuilder;
    }

    /**
     * @return Post[]
     */
    public function getResults(): array
    {
        return $this->getQuery()
            ->getQuery()
            ->getResult()
        ;
    }

    public function setTitle(string $title = null): self
    {
        $this->title = $title;

        return $this;
    }

    public function setCategories(array $categories = null): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function setPublicationDate(array $publicationDate = []): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    private function prepareCategoriesValues(): array
    {
        $result = [];

        foreach ($this->categories as $category) {
            $result[] = $category->value;
        }

        return $result;
    }
}
