<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Repository;

use App\Modules\Invoices\Domain\Entity\Invoice;

interface InvoiceRepositoryInterface
{
    public function findByNumber(string $number): ?Invoice;
    public function approve(string $id): void;
    public function reject(string $id): void;
}
