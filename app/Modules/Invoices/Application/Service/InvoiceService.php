<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Service;

use App\Infrastructure\Exceptions\ApplicationException;
use App\Modules\Invoices\Domain\Entity\Invoice;
use App\Modules\Invoices\Domain\Repository\InvoiceRepositoryInterface;

readonly class InvoiceService
{
    public function __construct(
        private InvoiceRepositoryInterface $invoiceRepository,
    ) {
    }

    public function showInvoice(string $number): Invoice
    {
        $invoice = $this->invoiceRepository->findByNumber($number);

        if (!$invoice) {
            throw new ApplicationException("Invoice $number not found");
        }

        return $invoice;
    }

    public function approveInvoice(string $id): void
    {
        $this->invoiceRepository->approve($id);
    }

    public function rejectInvoice(string $id): void
    {
        $this->invoiceRepository->reject($id);
    }
}
