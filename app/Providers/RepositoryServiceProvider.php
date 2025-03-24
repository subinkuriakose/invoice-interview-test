<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\CustomerInvoiceRepositoryInterface;
use App\Repositories\CustomerInvoiceRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerInvoiceRepositoryInterface::class, CustomerInvoiceRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
