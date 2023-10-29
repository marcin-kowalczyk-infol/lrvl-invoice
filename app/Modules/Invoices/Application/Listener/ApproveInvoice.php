<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Listener;

use App\Modules\Approval\Api\Events\EntityApproved;
use App\Modules\Invoices\Application\Service\InvoiceService;
use App\Modules\Invoices\Domain\Entity\Invoice;

readonly class ApproveInvoice
{
    public function __construct(
        private InvoiceService $invoiceService,
    ) {
    }

    public function handle(EntityApproved $event): void
    {
        if (Invoice::class === $event->approvalDto->entity) {
            $this->invoiceService->approveInvoice($event->approvalDto->id->toString());
        }
    }
}
