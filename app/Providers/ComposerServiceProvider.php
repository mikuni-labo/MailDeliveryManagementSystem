<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * return void
     */
    public function boot()
    {
        View::composer('*',      'App\Composers\View\FixtureComposer');
        View::composer('mail/*', 'App\Composers\View\MailComposer');
    }

    /**
     * Register
     *
     * return void
     */
    public function register()
    {
        //
    }

}
