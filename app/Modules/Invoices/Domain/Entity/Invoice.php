<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entity;

use App\Domain\ValueObjects\Money;

class Invoice implements \JsonSerializable
{
    public function __construct(
        private string $invoiceNumber,
        private \DateTime $invoiceDate,
        private \DateTime $dueDate,
        private Company $company,
        private Company $billedCompany,
        private array $products,
        private Money $invoiceTotal = new Money(0),
    ) {
        $this->calculateTotalPrice();
    }

    public function jsonSerialize(): array
    {
        return [
            'invoice_number' => $this->invoiceNumber,
            'date' => $this->invoiceDate->format('Y-m-d'),
            'due_date' => $this->dueDate->format('Y-m-d'),
            'company' => $this->company,
            'billed_company' => $this->billedCompany,
            'products' => $this->products,
            'total_price' => $this->invoiceTotal,
        ];
    }

    private function calculateTotalPrice(): void
    {
        foreach ($this->products as $productLine) {
            $this->invoiceTotal->increment($productLine['total']->getAmount());
        }
    }
}
