<?php
namespace Nova\MultiselectCheckboxes;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('novamultiselectcheckboxes', __DIR__.'/../dist/js/field.js');
            Nova::style('novamultiselectcheckboxes', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }
}
