<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->app->singleton(Gateway::class, function($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'kndtf8s6d96wf6by',
                    'publicKey' => 'qf542ywh7g9pbbwx',
                    'privateKey' => 'e2345a9fb6df209d922fa692fb471b16'
                ]
                );
        });
    }
}
