<?php

namespace Fletcher;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class FletcherServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'fletcher');
        
        Blade::component('wing', \Fletcher\Components\Wing::class);
    }

    public function register(): void
    {
        //
    }
}