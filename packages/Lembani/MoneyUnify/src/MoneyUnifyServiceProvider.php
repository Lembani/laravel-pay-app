<?php

namespace Lembani\MoneyUnify;

use Illuminate\Support\ServiceProvider;

class MoneyUnifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MoneyUnifyClient::class, function ($app) {
            return new MoneyUnifyClient();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/moneyunify.php' => config_path('moneyunify.php'),
        ], 'config');
    }
}
