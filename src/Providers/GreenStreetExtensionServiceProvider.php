<?php

namespace GreenStreet\Extension\Providers;

use GreenStreet\Extension\Services\SalesTaxCalculator;
use GreenStreet\Extension\Services\Strtipe;
use Illuminate\Support\ServiceProvider;

class GreenStreetExtensionServiceProvider extends ServiceProvider
{
    public function register(): void
    {

//        $this->app->bind(
//            \GreenStreet\Extension\Services\UserService::class
//        );

//        $this->app->bind(
//            \GreenStreet\Extension\Services\PaymentProcessor::class,
//            \GreenStreet\Extension\Services\Strtipe::class
//        );

        $this->app->bind(
            \GreenStreet\Extension\Services\PaymentProcessor::class,
            function ($app) {
                return new Strtipe([], $app->make(SalesTaxCalculator::class,
                    ['config' => []]
                ));
            }
        );


        $this->app->bind(
            \GreenStreet\Extension\Services\PaymentProcessor::class,
            function ($app) {
                return $app->make(Strtipe::class);
            }
        );

        $this->mergeConfigFrom(
            __DIR__.'/../../config/extension.php', 'greenstreet.extension'
        );
    }

    public function boot(): void
    {
        $this->publishesMigrations([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/../../routes/extension.php');
        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('greenstreet/extension'),
        ]);
    }
}
