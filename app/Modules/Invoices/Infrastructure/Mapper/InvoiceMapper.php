<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Mapper;

use App\Domain\ValueObjects\Address;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use App\Domain\ValueObjects\Phone;
use App\Modules\Invoices\Domain\Entity\Company;
use App\Modules\Invoices\Domain\Entity\Invoice;
use App\Modules\Invoices\Domain\Entity\Product;
use App\Modules\Invoices\Infrastructure\Model\Invoice as InvoiceModel;
use Illuminate\Database\Eloquent\Collection;

class InvoiceMapper
{
    public static function toDomainRepresentation(InvoiceModel $model): Invoice
    {
        $company = new Company(
            $model->company->name,
            new Address(
                $model->company->street,
                $model->company->city,
                $model->company->zip,
            ),
            new Phone($model->company->phone),
        );

        $billedCompany = new Company(
            $model->billedCompany->name,
            new Address(
                $model->billedCompany->street,
                $model->billedCompany->city,
                $model->billedCompany->zip,
            ),
            new Phone($model->billedCompany->phone),
            new Email($model->billedCompany->email),
        );

        return new Invoice(
            $model->number,
            $model->date,
            $model->due_date,
            $company,
            $billedCompany,
            self::getProducts($model->productLines),
        );
    }

    /**
     * @return Product[]
     */
    public static function getProducts(Collection $productLines): array
    {
        $data = [];
        foreach ($productLines as $product) {
            $total = $product->product->price * $product->quantity;
            $data[] = [
                'product' => new Product(
                    $product->product->name,
                    new Money($product->product->price),
                ),
                'quantity' => $product->quantity,
                'total' => new Money($total),
            ];
        }

        return $data;
    }
}
