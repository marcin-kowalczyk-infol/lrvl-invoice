<?php

declare(strict_types=1);

namespace App\Infrastructure\Providers;

use App\Modules\Invoices\Domain\Repository\InvoiceRepositoryInterface;
use App\Modules\Invoices\Infrastructure\Repository\InvoiceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
