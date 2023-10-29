<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

final readonly class Email
{
    public function __construct(
        private string $email,
    ) {
    }

    public function __toString(): string
    {
        return (string) $this->email;
    }
}
