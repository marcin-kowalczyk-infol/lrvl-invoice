<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Listener;

use App\Modules\Approval\Api\Events\EntityRejected;
use App\Modules\Invoices\Application\Service\InvoiceService;
use App\Modules\Invoices\Domain\Entity\Invoice;

readonly class RejectInvoice
{
    public function __construct(
        private InvoiceService $invoiceService,
    ) {
    }

    public function handle(EntityRejected $event): void
    {
        if (Invoice::class === $event->approvalDto->entity) {
            $this->invoiceService->rejectInvoice($event->approvalDto->id->toString());
        }
    }
}
