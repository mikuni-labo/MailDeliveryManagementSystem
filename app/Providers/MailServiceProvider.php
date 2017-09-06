<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Upload visitor csv.
         */
        $this->app->when(\App\Http\Controllers\Mail\Set\DeliveryController::class)
            ->needs(\App\Services\Mail\MailServiceInterface::class)
            ->give(\App\Services\Mail\DeliveryMailService::class);

    }
}
