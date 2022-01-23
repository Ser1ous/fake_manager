<?php namespace EvolutionCMS\Manager\Providers;

use EvolutionCMS\ServiceProvider;
use EvolutionCMS\Manager\ManagerTheme;
use EvolutionCMS\Manager\Interfaces\ManagerThemeInterface;

class ManagerThemeServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    protected $namespace = 'manager';

    /**
     * @return void
     * Register view for manager
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', $this->namespace);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ManagerTheme', function ($app) {
            $theme = $this->app->getConfig('manager_theme', 'default');
            $this->loadSnippetsFrom(
                MODX_MANAGER_THEME_PATH . 'media/style/' . $theme . '/snippets/',
                $this->namespace
            );
            $this->loadChunksFrom(
                MODX_MANAGER_THEME_PATH . 'media/style/' . $theme . '/chunks/',
                $this->namespace
            );
            return new ManagerTheme($app, $theme);
        });

        $this->app->alias('ManagerTheme', ManagerThemeInterface::class);
        $this->app->alias('ManagerTheme', ManagerTheme::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ManagerTheme'];
    }
}
