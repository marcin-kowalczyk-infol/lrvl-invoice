<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

final readonly class Address implements \JsonSerializable
{
    public function __construct(
        private string $street,
        private string $city,
        private string $zipCode,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'street' => $this->street,
            'city' => $this->city,
            'zip' => $this->zipCode,
        ];
    }
}
