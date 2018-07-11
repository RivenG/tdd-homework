<?php

namespace Homework\Providers;


use Homework\Algorithm\Luhn;
use Homework\Services\CardNumberGenerator;
use Illuminate\Support\ServiceProvider;

class CardNumberGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cardNumberGenerator', function(){
            return new CardNumberGenerator(new Luhn());
        });
    }
}
