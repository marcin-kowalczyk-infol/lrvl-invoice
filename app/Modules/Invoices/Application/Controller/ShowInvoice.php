<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Controller;

use App\Infrastructure\Controller;
use App\Modules\Invoices\Application\Service\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowInvoice extends Controller
{
    public function __construct(private readonly InvoiceService $invoiceService)
    {
    }

    public function __invoke(Request $request, string $number): JsonResponse
    {
        try {
            $invoice = $this->invoiceService->showInvoice($number);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        return response()->json($invoice);
    }
}
