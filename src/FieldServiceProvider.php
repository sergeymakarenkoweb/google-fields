<?php

namespace MakarenkoSergey\GoogleFields;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\NovaServiceProviderRegistered;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Override ActionController after NovaServiceProvider loaded
        Event::listen(NovaServiceProviderRegistered::class, function () {
            app('router')->middleware('nova')->post('/nova-api/get-spaces/lala',
                ['uses' => 'MakarenkoSergey\GoogleFields\Http\Controller\GoogleAssistantController@getPlacesByAddress']);
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('google-fields', __DIR__.'/../dist/js/field.js');
            Nova::style('google-fields', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
