<?php

declare(strict_types=1);

namespace App\Post\Presentation\Admin\Controller;

use App\Post\Application\Admin\Command\CreatePostCommand;
use App\Shared\Presentation\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/post', name: 'admin_post_')]
class PostController extends AbstractController
{
    #[Route(name: 'create', methods: [Request::METHOD_POST])]
    public function create(CreatePostCommand $command): Response
    {
        $this->dispatchCommand($command);

        return $this->emptyResponse();
    }
}
