<?php

declare(strict_types=1);

namespace App\Post\Presentation\Api\Controller;

use App\Post\Application\Api\Query\GetPostQuery;
use App\Shared\Presentation\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/post', name: 'api_post_')]
class PostController extends AbstractController
{
    #[Route(name: 'list', methods: [Request::METHOD_GET])]
    public function list(GetPostQuery $query): Response
    {
        return $this->successResponse($this->dispatchQuery($query));
    }
}
