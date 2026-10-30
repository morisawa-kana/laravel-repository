<?php

/*
 * @Author: もりさわかな
 * @LastEditTime: 2026-05-06 11:14:28
 */

namespace Morisawa\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 *
 * @author Morisawa Kana
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../Resource/repository.php' => config_path('repository.php'),
        ]);
        $this->mergeConfigFrom(__DIR__.'/../../Resource/repository.php', 'repository');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('Morisawa\Generators\Commands\RepositoryCommand');
        $this->commands('Morisawa\Generators\Commands\ControllerCommand');
        $this->commands('Morisawa\Generators\Commands\CriteriaCommand');
        $this->commands('Morisawa\Generators\Commands\LangCommand');
        $this->commands('Morisawa\Generators\Commands\RequestCommand');
        $this->commands('Morisawa\Generators\Commands\ModelCommand');
        $this->commands('Morisawa\Generators\Commands\JobCommand');
        $this->commands('Morisawa\Generators\Commands\BindingsCommand');
        $this->app->register('Morisawa\Providers\EventServiceProvider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
