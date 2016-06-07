<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider {

    public function register(){

        // Seleccion de la interface de billing que quiero usar
        $this->app->bind('App\Billing\BillingInterface', 'App\Billing\StripeBilling');

    }

}