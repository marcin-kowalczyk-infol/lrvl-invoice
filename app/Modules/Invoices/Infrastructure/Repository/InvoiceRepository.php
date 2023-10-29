<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Repository;

use App\Domain\Enums\StatusEnum;
use App\Infrastructure\Exceptions\ApplicationException;
use App\Modules\Invoices\Domain\Entity\Invoice;
use App\Modules\Invoices\Domain\Repository\InvoiceRepositoryInterface;
use App\Modules\Invoices\Infrastructure\Mapper\InvoiceMapper;
use App\Modules\Invoices\Infrastructure\Model\Invoice as InvoiceModel;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function findByNumber(string $number): ?Invoice
    {
        $invoiceModel = InvoiceModel::where('number', $number)->first();

        return null !== $invoiceModel ? InvoiceMapper::toDomainRepresentation($invoiceModel) : $invoiceModel;
    }

    public function approve(string $id): void
    {
        $invoiceModel = InvoiceModel::find($id);
        if (!$invoiceModel) {
            throw new ApplicationException("Invoice $id not found");
        }

        if (StatusEnum::DRAFT !== $invoiceModel->status) {
            throw new ApplicationException("Invoice $id status is already set");
        }

        $invoiceModel->status = StatusEnum::APPROVED;
        $invoiceModel->save();
    }

    public function reject(string $id): void
    {
        $invoiceModel = InvoiceModel::find($id);
        if (!$invoiceModel) {
            throw new ApplicationException("Invoice $id not found");
        }

        if (StatusEnum::DRAFT !== $invoiceModel->status) {
            throw new ApplicationException("Invoice $id status is already set");
        }

        $invoiceModel->status = StatusEnum::REJECTED;
        $invoiceModel->save();
    }
}
