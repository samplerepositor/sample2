<?php

declare(strict_types=1);

namespace App\Post\Infrastructure\Persistence\Doctrine\Repository\Post;

use App\Post\Domain\Exception\PostNotFoundException;
use App\Post\Domain\Post;
use App\Post\Domain\PostFilterInterface;
use App\Post\Domain\PostRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class DoctrineORMRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function store(Post $post): void
    {
        $this->getEntityManager()->persist($post);
        $this->getEntityManager()->flush();
    }

    public function findOne(Uuid $id): Post
    {
        $post = $this->find($id);

        if (null === $post) {
            throw new PostNotFoundException('post.not_found');
        }

        return $post;
    }

    public function createPostFilters(): PostFilterInterface
    {
        return new PostFilters($this->_em);
    }

    /**
     * @return Post[]
     */
    public function findActivePosts(): array
    {
        $now = DateTimeProvider::current();

        return $this->createQueryBuilder('p')
            ->andWhere('p.publicationDate.from <= :date OR p.publicationDate.from IS NULL')
            ->andWhere('p.publicationDate.to >= :date OR p.publicationDate.to IS NULL')
            ->setParameter('date', $now)
            ->addOrderBy('p.publicationDate.from', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
