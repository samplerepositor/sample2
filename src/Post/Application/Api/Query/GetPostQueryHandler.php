<?php

declare(strict_types=1);

namespace App\Post\Application\Api\Query;

use App\Post\Application\Api\View\PostListElementView;
use App\Post\Application\Api\View\PostListView;
use App\Post\Domain\Post;
use App\Post\Domain\PostRepositoryInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'query_bus')]
class GetPostQueryHandler
{
    public function __construct(
        private PostRepositoryInterface $repository,
        private PaginatorInterface $paginator,
    ) {
    }

    public function __invoke(GetPostQuery $query): PaginationInterface
    {
        return $this->paginator->paginate($this->mapResults($this->repository->findActivePosts()), $query->page, $query->limit);
    }

    private function mapResults(array $posts): PostListView
    {
        return new PostListView(array_map(function (Post $post) {
            return PostListElementView::create($post);
        }, $posts));
    }
}
