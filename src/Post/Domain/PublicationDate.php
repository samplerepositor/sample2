<?php

declare(strict_types=1);

namespace App\Post\Domain;

use DateTimeImmutable;

class PublicationDate
{
    final private function __construct(protected ?DateTimeImmutable $from = null, protected ?DateTimeImmutable $to = null)
    {
    }

    public static function create(?DateTimeImmutable $from = null, ?DateTimeImmutable $to = null): static
    {
        return new static($from, $to);
    }

    public function getFrom(): ?DateTimeImmutable
    {
        return $this->from;
    }

    public function getTo(): ?DateTimeImmutable
    {
        return $this->to;
    }
}
