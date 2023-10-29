<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

final class Money implements \JsonSerializable
{
    public function __construct(
        private float $amount,
        private readonly string $currency = 'USD',
    ) {
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function increment(float|int $value): void
    {
        $this->amount += $value;
    }

    public function format(): string
    {
        return \sprintf("%s %s", $this->currency, \number_format($this->getAmount()));
    }

    public function jsonSerialize(): array
    {
        return [
            'amount' => $this->getAmount(),
            'currency' => $this->currency,
        ];
    }
}
