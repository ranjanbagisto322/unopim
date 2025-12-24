<?php

namespace Webkul\Measurement\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Webkul\Measurement\Helpers\MeasurementHelper;

class MeasurementServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'measurement');

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
                    'measurement::catalog.attributes.edit',
                    [
                        'attribute' => $attribute
                    ]
                );
            }
        );
    
        Event::listen(
            'unopim.admin.products.dynamic-attribute-fields.control.measurement.before',
            function ($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate(
                    'measurement::catalog.products.edit'
                );
            }
        );

        Event::listen(
            'catalog.attribute.update.before',
            'Webkul\Measurement\Listeners\ValidateAttributeMeasurementBeforeUpdate@handle'
        );


    }

    
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
