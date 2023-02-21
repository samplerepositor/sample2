<?php

declare(strict_types=1);

namespace App\Post\Application\Api\Query;

use Symfony\Component\Validator\Constraints as Assert;

class GetPostQuery
{
    public function __construct(
        #[Assert\GreaterThanOrEqual(1), Assert\Type('int')]
        public int $page = 1,
        #[Assert\Range(min: 1, max: 1000), Assert\Type('int')]
        public int $limit = 10
    ) {
    }
}
