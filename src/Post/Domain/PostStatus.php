<?php

declare(strict_types=1);

namespace App\Post\Domain;

enum PostStatus: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}
