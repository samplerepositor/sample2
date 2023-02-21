<?php

declare(strict_types=1);

namespace App\Post\Domain;

enum Category: string
{
    case NEWS = 'NEWS';
    case BLOG = 'BLOG';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
