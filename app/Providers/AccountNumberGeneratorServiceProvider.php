<?php

namespace Homework\Providers;


use Homework\Services\AccountNumberGenerator;
use Illuminate\Support\ServiceProvider;

class AccountNumberGeneratorServiceProvider extends ServiceProvider
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
        $this->app->singleton('accountNumberGenerator', function(){
            return new AccountNumberGenerator();
        });
    }
}
