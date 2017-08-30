<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CsvServiceProvider extends ServiceProvider
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
        $this->app->when(\App\Http\Controllers\Visitor\Csv\UploadController::class)
            ->needs(\App\Services\Csv\CsvServiceInterface::class)
            ->give(\App\Services\Csv\Visitor\UploadCsvService::class);

        /**
         * Download sample visitor csv.
         */
        $this->app->when(\App\Http\Controllers\Visitor\Csv\DownloadSampleController::class)
            ->needs(\App\Services\Csv\CsvServiceInterface::class)
            ->give(\App\Services\Csv\Visitor\DownloadSampleCsvService::class);
    }
}
