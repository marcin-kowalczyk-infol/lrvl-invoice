<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entity;

use App\Domain\ValueObjects\Money;

final readonly class Product implements \JsonSerializable
{
    public function __construct(
        private string $name,
        private Money $unitPrice,
    ) {
    }

    public function getUnitPrice(): Money
    {
        return $this->unitPrice;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'unit_price' => $this->getUnitPrice(),
        ];
    }
}
