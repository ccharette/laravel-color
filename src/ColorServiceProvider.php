<?php

namespace Gallea\Color;

use Gallea\Color\Tools\Categorie;
use Illuminate\Support\ServiceProvider;

class ColorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Categorie', function ($app) {
            return new Categorie($app->make('HttpClient'));
        });
        $this->mergeConfigFrom(
            __DIR__.'/config/colors.php', 'colors'
        );
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'color');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/2020_03_18_153445_create_color_categories_table.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/colors.php' => config_path('colors.php'),
        ]);
    }
}
