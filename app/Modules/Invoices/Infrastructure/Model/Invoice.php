<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    protected $fillable = [
        'id',
        'number',
        'date',
        'due_date',
        'company_id',
        'billed_company_id',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date' => 'date',
        'due_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function billedCompany(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'billed_company_id');
    }

    public function productLines(): HasMany
    {
        return $this->hasMany(InvoiceProductLines::class, 'invoice_id', 'id');
    }
}
