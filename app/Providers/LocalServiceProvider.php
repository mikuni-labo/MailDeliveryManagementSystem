<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LocalServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $providers = [
        \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,   // IDE Helper
        \Barryvdh\Debugbar\ServiceProvider::class,                    // デバッガ
    ];

    /**
     * @var array
     */
    protected $aliases = [
        'Debugbar' => \Barryvdh\Debugbar\Facade::class,
    ];

    /**
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal())
        {
            $this->registerProviders();
            $this->registerAliases();
        }
    }

    /**
     * @return void
     */
    protected function registerProviders()
    {
        if (!empty($this->providers))
        {
            foreach ($this->providers as $provider) {
                $this->app->register($provider);
            }
        }
    }

    /**
     * @return void
     */
    protected function registerAliases()
    {
        if (!empty($this->aliases)) {
            $loader = AliasLoader::getInstance();

            foreach ($this->aliases as $alias => $facade) {
                $loader->alias($alias, $facade);
            }
        }
    }

}
