<?php

namespace Webkul\Measurement\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MeasurementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Load migrations, translations, views, routes
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'measurement');

        // ✅ FIX: view path folder name should be "views", not "view"
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'measurement');

        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/attribute_types.php',
            'attribute_types'
        );

        Event::listen(
            'unopim.admin.catalog.attributes.edit.card.label.after',
            function ($viewRenderEventManager, $attribute = null) {

                $viewRenderEventManager->addTemplate(
                    'measurement::admin.attributes.custom-field'
                );
            }
        );

    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $menu = require dirname(__DIR__).'/Config/menu.php';

        config([
            'menu.admin' => array_merge(
                config('menu.admin', []),
                $menu
            ),
        ]);

    }
}
