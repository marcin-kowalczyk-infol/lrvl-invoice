<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

final readonly class Phone
{
    public function __construct(
        private string $value,
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
